<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Verifikasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\Permintaan;

class VerifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $verifikasis = Verifikasi::with(['user', 'bidang', 'permintaans'])->get();


            $verifikasis->map(function ($verifikasi) {
                $verifikasi->permintaans->map(function ($permintaan) {
                    $stock = DB::table('stock_opnames')->where('id', $permintaan->kode_barang)->first();
                    $permintaan->jumlah_stock = $stock ? $stock->jumlah : 0;
                    return $permintaan;
                });
                return $verifikasi;
            });

            return response()->json([
                'success' => true,
                'data' => $verifikasis,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data verifikasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tanggal' => now(),
                'status' => 'nullable|string|in:DIPROSES,ACC KABID,ACC SEKRETARIAT,ACC PPTKSEKRETARIAT',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $validated = $validator->validated();

            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // Cek apakah sudah ada pengajuan dari bidang ini di bulan dan tahun yang sama
            $existingVerifikasi = Verifikasi::where('id_bidang', $user->id_bidang)
                ->whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)
                ->first();

            if ($existingVerifikasi) {
                return response()->json([
                    'message' => 'Pengajuan sudah dilakukan oleh bidang Anda pada bulan ini.'
                ], 400);
            }


            $carts = Cart::where('id_user', $user->id)->with('stockOpname')->get();
            if ($carts->isEmpty()) {
                return response()->json(['message' => 'Cart kosong, tidak ada barang untuk diajukan'], 400);
            }

            DB::beginTransaction();

            // Buat entri verifikasi
            $verifikasi = Verifikasi::create([
                'tanggal' => now(),
                'status' => $validated['status'] ?? 'DIPROSES',
                'id_user' => $user->id,
                'id_bidang' => $user->id_bidang ?? null,
            ]);

            // Proses tiap item cart jadi permintaan
            foreach ($carts as $cart) {
                $stock = $cart->stockOpname;
                if (!$stock) {
                    DB::rollBack();
                    return response()->json(['message' => 'Stok tidak ditemukan untuk salah satu item cart'], 400);
                }

                if ($stock->jumlah < $cart->jumlah) {
                    DB::rollBack();
                    return response()->json(['message' => "Stok barang '{$stock->nama_barang}' tidak mencukupi"], 400);
                }

                // Simpan ke tabel permintaan
                Permintaan::create([
                    'nama_barang' => $stock->nama_barang ?? 'Tidak diketahui',
                    'jumlah' => $cart->jumlah,
                    'satuan' => $stock->satuan ?? '-',
                    'kode_barang' => $stock->id,
                    'keterangan' => $stock->keterangan ?? '-',
                    'id_verifikasi' => $verifikasi->id,
                ]);

                // Kurangi jumlah stok
                $stock->jumlah -= $cart->jumlah;
                $stock->save();
            }

            // Hapus cart setelah diproses
            Cart::where('id_user', $user->id)->delete();

            DB::commit();

            return response()->json([
                'message' => 'Pengajuan berhasil disimpan',
                'verifikasi' => $verifikasi
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal simpan verifikasi: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getByBidang()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // Pastikan user memiliki bidang
            if (!$user->id_bidang) {
                return response()->json(['message' => 'User tidak memiliki bidang'], 400);
            }

            // Ambil semua verifikasi berdasarkan bidang yang sama
            $verifikasis = Verifikasi::with(['user', 'bidang', 'permintaans'])
                ->where('id_bidang', $user->id_bidang)
                ->orderBy('tanggal', 'desc')
                ->get();

            $verifikasis->map(function ($verifikasi) {
                $verifikasi->permintaans->map(function ($permintaan) {
                    $stock = DB::table('stock_opnames')->where('id', $permintaan->kode_barang)->first();
                    $permintaan->jumlah_stock = $stock ? $stock->jumlah : 0;
                    return $permintaan;
                });
                return $verifikasi;
            });

            return response()->json([
                'success' => true,
                'data' => $verifikasis,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data berdasarkan bidang',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getRekapTahunan(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            if (!$user->id_bidang) {
                return response()->json(['message' => 'User tidak memiliki bidang'], 400);
            }

            $tahun = $request->get('tahun', date('Y'));
            $verifikasis = Verifikasi::with('permintaans')
                ->where('id_bidang', $user->id_bidang)
                ->whereYear('tanggal', $tahun)
                ->where('status', 'ACC PPTK SEKRETARIAT')
                ->get();

            $rekap = [];
            foreach ($verifikasis as $verifikasi) {
                foreach ($verifikasi->permintaans as $permintaan) {
                    $kode = $permintaan->kode_barang;

                    if (!isset($rekap[$kode])) {
                        $rekap[$kode] = [
                            'kode_barang' => $kode,
                            'nama_barang' => $permintaan->nama_barang,
                            'satuan'      => $permintaan->satuan,
                            'jumlah'      => 0,
                        ];
                    }
                    $rekap[$kode]['jumlah'] += $permintaan->jumlah;
                }
            }

            return response()->json([
                'success' => true,
                'tahun'   => $tahun,
                'data'    => array_values($rekap),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil rekap tahunan',
                'error'   => $e->getMessage()
            ], 500);
        }
    }




    public function setVerifKabid(Request $request, $id)
    {
        try {
            $user = Auth::user();
            if (!$user || $user->role !== 'KABID') {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // Cari data verifikasi dengan ID dan status 'DIPROSES'
            $verifikasi = Verifikasi::where('id', $id)
                ->where('status', 'DIPROSES')
                ->first();

            if (!$verifikasi) {
                return response()->json([
                    'message' => 'Verifikasi tidak ditemukan atau sudah diverifikasi'
                ], 404);
            }

            // Cek apakah bidang verifikasi sama dengan bidang user login
            if ($verifikasi->id_bidang !== $user->id_bidang) {
                return response()->json([
                    'message' => 'Anda hanya dapat memverifikasi pengajuan dari bidang Anda sendiri'
                ], 403);
            }

            // Update status
            $verifikasi->status = 'ACC KABID';
            $verifikasi->save();

            return response()->json([
                'message' => 'Status verifikasi berhasil diupdate',
                'verifikasi' => $verifikasi
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal update status verifikasi: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengupdate status verifikasi',
                'error' => config('app.debug') ? $e->getMessage() : 'Silakan coba lagi nanti'
            ], 500);
        }
    }

    public function diproses()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            $verifikasis = Verifikasi::with(['permintaans', 'bidang'])
                ->where('status', 'DIPROSES')
                ->where('id_bidang', $user->id_bidang)
                ->orderBy('created_at', 'desc')
                ->get();


            $verifikasis->map(function ($verifikasi) {
                $verifikasi->permintaans->map(function ($permintaan) {
                    $stock = DB::table('stock_opnames')->where('id', $permintaan->kode_barang)->first();
                    $permintaan->jumlah_stock = $stock ? $stock->jumlah : 0;
                    return $permintaan;
                });
                return $verifikasi;
            });


            return response()->json([
                'success' => true,
                'message' => 'Data verifikasi dengan status DIPROSES berhasil diambil',
                'total' => $verifikasis->count(),
                'data' => $verifikasis,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Gagal mengambil data verifikasi diproses: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data',
                'error' => config('app.debug') ? $e->getMessage() : 'Silakan coba lagi nanti'
            ], 500);
        }
    }


    public function setVerifSekre(Request $request, $id)
    {
        try {
            $user = Auth::user();
            if (!$user || $user->role !== 'SEKRETARIS') {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // Cari data verifikasi dengan ID dan status 'DIPROSES'
            $verifikasi = Verifikasi::where('id', $id)
                ->where('status', 'ACC KABID')
                ->first();

            if (!$verifikasi) {
                return response()->json([
                    'message' => 'Verifikasi tidak ditemukan atau sudah diverifikasi'
                ], 404);
            }
            // Update status
            $verifikasi->status = 'ACC SEKRETARIS';
            $verifikasi->save();

            return response()->json([
                'message' => 'Status verifikasi berhasil diupdate',
                'verifikasi' => $verifikasi
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal update status verifikasi: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengupdate status verifikasi',
                'error' => config('app.debug') ? $e->getMessage() : 'Silakan coba lagi nanti'
            ], 500);
        }
    }

    public function accKabid()
    {
        try {

            $verifikasis = Verifikasi::with(['permintaans', 'bidang'])
                ->where('status', 'ACC KABID')
                ->orderBy('created_at', 'desc')
                ->get();

            $verifikasis->map(function ($verifikasi) {
                $verifikasi->permintaans->map(function ($permintaan) {
                    $stock = DB::table('stock_opnames')->where('id', $permintaan->kode_barang)->first();
                    $permintaan->jumlah_stock = $stock ? $stock->jumlah : 0;
                    return $permintaan;
                });
                return $verifikasi;
            });

            return response()->json([
                'success' => true,
                'message' => 'Data verifikasi dengan status ACC KABID berhasil diambil',
                'total' => $verifikasis->count(),
                'data' => $verifikasis,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Gagal mengambil data verifikasi ACC KABID: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data',
                'error' => config('app.debug') ? $e->getMessage() : 'Silakan coba lagi nanti'
            ], 500);
        }
    }

    public function setVerifPptk(Request $request, $id)
    {
        try {
            $user = Auth::user();
            if (!$user || $user->role !== 'PPTK SEKRETARIAT') {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // Cari data verifikasi dengan ID dan status 'DIPROSES'
            $verifikasi = Verifikasi::where('id', $id)
                ->where('status', 'ACC SEKRETARIS')
                ->first();

            if (!$verifikasi) {
                return response()->json([
                    'message' => 'Verifikasi tidak ditemukan atau sudah diverifikasi'
                ], 404);
            }
            // Update status
            $verifikasi->status = 'ACC PPTK SEKRETARIAT';
            $verifikasi->menyetujui = $user->nama;
            $verifikasi->tanggal_acc = now();
            $verifikasi->save();

            return response()->json([
                'message' => 'Status verifikasi berhasil diupdate',
                'verifikasi' => $verifikasi
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal update status verifikasi: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengupdate status verifikasi',
                'error' => config('app.debug') ? $e->getMessage() : 'Silakan coba lagi nanti'
            ], 500);
        }
    }
    public function accSekre()
    {
        try {
            $verifikasis = Verifikasi::with(['permintaans', 'bidang'])
                ->where('status', 'ACC SEKRETARIS')
                ->orderBy('created_at', 'desc')
                ->get();

            $verifikasis->map(function ($verifikasi) {
                $verifikasi->permintaans->map(function ($permintaan) {
                    $stock = DB::table('stock_opnames')->where('id', $permintaan->kode_barang)->first();
                    $permintaan->jumlah_stock = $stock ? $stock->jumlah : 0;
                    return $permintaan;
                });
                return $verifikasi;
            });

            return response()->json([
                'success' => true,
                'message' => 'Data verifikasi dengan status ACC SEKRETARIS berhasil diambil',
                'total' => $verifikasis->count(),
                'data' => $verifikasis,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Gagal mengambil data verifikasi ACC SEKRETARIS: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data',
                'error' => config('app.debug') ? $e->getMessage() : 'Silakan coba lagi nanti'
            ], 500);
        }
    }
}
