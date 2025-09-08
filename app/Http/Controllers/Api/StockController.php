<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HistoryStock;
use App\Models\StockOpname;
use App\Models\BarangHabis;
use App\Models\BarangMasih;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            Carbon::setLocale('id');

            $now = Carbon::now();
            $currentMonth = $now->month;
            $currentYear = $now->year;

            DB::beginTransaction();

            // Ambil semua stok dari tabel utama
            $stockItems = StockOpname::all();

            foreach ($stockItems as $item) {
                $alreadyInMasih = BarangMasih::where('nama_barang', $item->nama_barang)
                    ->whereDate('tanggal', $item->tanggal)
                    ->exists();

                $alreadyInHabis = BarangHabis::where('nama_barang', $item->nama_barang)
                    ->whereDate('tanggal', $item->tanggal)
                    ->exists();


                // Jika jumlah > 0, dan data belum ada di BarangMasih bulan ini, insert
                if ($item->jumlah > 0 && !$alreadyInMasih) {
                    BarangMasih::create([
                        'nama_barang' => $item->nama_barang,
                        'jumlah' => $item->jumlah,
                        'satuan' => $item->satuan,
                        'tanggal' => $item->tanggal,
                    ]);
                }

                // Jika jumlah == 0, dan data belum ada di BarangHabis bulan ini, insert
                if ($item->jumlah == 0 && !$alreadyInHabis) {
                    BarangHabis::create([
                        'nama_barang' => $item->nama_barang,
                        'tanggal' => $item->tanggal,
                    ]);
                }

                // Realtime update: hapus dari tabel yang tidak sesuai dengan jumlah sekarang
                if ($item->jumlah == 0) {
                    // jika jumlah 0, hapus dari barangmasih bulan ini
                    BarangMasih::where('nama_barang', $item->nama_barang)
                        ->whereMonth('tanggal', $currentMonth)
                        ->whereYear('tanggal', $currentYear)
                        ->delete();
                } else {
                    // jika jumlah > 0, hapus dari baranghabis bulan ini
                    BarangHabis::where('nama_barang', $item->nama_barang)
                        ->whereMonth('tanggal', $currentMonth)
                        ->whereYear('tanggal', $currentYear)
                        ->delete();
                }
            }

            DB::commit();

            $stockOpname = StockOpname::all();

            if ($stockOpname->count() > 0) {
                $formatted = $stockOpname->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'nama_barang' => $item->nama_barang,
                        'Jumlah' => $item->jumlah,
                        'satuan' => $item->satuan,
                        'Harga Satuan' => $item->harga,
                        'bulan' => $item->tanggal->translatedFormat('F'),
                        'tahun' => $item->tanggal->format('Y'),
                    ];
                });

                return response()->json([
                    'success' => true,
                    'message' => 'List semua data stock opname (jumlah > 0)',
                    'data' => $formatted
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Data stock opname kosong',
                'data' => []
            ], 404);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function store(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'nama_barang' => 'required|string|max:255|unique:stock_opnames,nama_barang',
                'jumlah' => 'required|integer',
                'satuan' => 'required|string|max:50',
                'harga' => 'required|numeric',
                'tanggal' => 'nullable|date_format:Y-m-d',
            ]);
            $validated['tanggal'] = $validated['tanggal'] ?? now()->format('Y-m-d');
            // Simpan ke database
            $stockOpname = StockOpname::create($validated);

            //masukkan data ke dalam history stock
            $historyData = [
                'id_stock' => $stockOpname->id,
                'nama_barang' => $stockOpname->nama_barang,
                'jumlah' => $stockOpname->jumlah,
                'satuan' => $stockOpname->satuan,
                'harga' => $stockOpname->harga,
                'tanggal' => $stockOpname->tanggal,
            ];
            HistoryStock::create($historyData);

            return response()->json([
                'success' => true,
                'message' => 'Data stock opname berhasil ditambahkan',
                'data' => $stockOpname
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => config('app.debug') ? $e->getMessage() : 'Silakan coba lagi nanti'
            ], 500);
        }
    }

    public function show(string $id)
    {
        $stockOpname = StockOpname::find($id);

        if ($stockOpname) {
            $formatted = [
                'id' => $stockOpname->id,
                'nama_barang' => $stockOpname->nama_barang,
                'Jumlah' => $stockOpname->jumlah,
                'satuan' => $stockOpname->satuan,
                'Harga Satuan' => $stockOpname->harga,
                'jumlah' => $stockOpname->jumlah * $stockOpname->harga,
                'bulan' => $stockOpname->tanggal->format('F'),
                'tahun' => $stockOpname->tanggal->format('Y'),
            ];

            return response()->json([
                'success' => true,
                'message' => 'Detail data stock opname',
                'data' => $formatted
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data stock opname tidak ditemukan',
            'data' => []
        ], 404);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $stockOpname = StockOpname::find($id);
            if (!$stockOpname) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data stock opname tidak ditemukan',
                    'data' => []
                ], 404);
            }

            $tanggalLama = $stockOpname->tanggal; // Simpan tanggal lama sebelum update

            $validated = $request->validate([
                'nama_barang' => 'required|string|max:255|unique:stock_opnames,nama_barang,' . $id,
                'jumlah' => 'required|integer',
                'satuan' => 'required|string|max:50',
                'tanggal' => 'nullable|date_format:Y-m-d',
                'harga' => 'required|numeric',
            ]);

            // Paksa tanggal menjadi now() saat update
            $validated['tanggal'] = now()->format('Y-m-d');

            $stockOpname->update($validated);

            // Cek apakah status jumlah berubah dan update barangmasih / baranghabis
            $currentMonth = now()->month;
            $currentYear = now()->year;

            if ($validated['jumlah'] == 0) {
                // Pindah ke BarangHabis
                // Hapus dari BarangMasih jika sebelumnya masih
                BarangMasih::where('nama_barang', $validated['nama_barang'])
                    ->whereMonth('tanggal', $currentMonth)
                    ->whereYear('tanggal', $currentYear)
                    ->delete();

                // Tambah ke BarangHabis (jika belum ada)
                BarangHabis::updateOrCreate(
                    [
                        'nama_barang' => $validated['nama_barang'],
                        'tanggal' => now()->format('Y-m-d'),
                    ],
                    [] // tidak ada field tambahan
                );
            } else {
                // Pindah ke BarangMasih
                // Hapus dari BarangHabis jika sebelumnya habis
                BarangHabis::where('nama_barang', $validated['nama_barang'])
                    ->whereMonth('tanggal', $currentMonth)
                    ->whereYear('tanggal', $currentYear)
                    ->delete();

                // Tambah/update di BarangMasih
                BarangMasih::updateOrCreate(
                    [
                        'nama_barang' => $validated['nama_barang'],
                        'tanggal' => now()->format('Y-m-d'),
                    ],
                    [
                        'jumlah' => $validated['jumlah'],
                        'satuan' => $validated['satuan'],
                    ]
                );
            }

            $historyData = [
                'nama_barang' => $validated['nama_barang'],
                'jumlah' => $validated['jumlah'],
                'satuan' => $validated['satuan'],
                'tanggal' => $tanggalLama, // tetap gunakan tanggal lama untuk history
            ];

            HistoryStock::where('id_stock', $stockOpname->id)
                ->update($historyData);

            return response()->json([
                'success' => true,
                'message' => 'Data stock opname berhasil diperbarui',
                'data' => $stockOpname
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data',
                'error' => config('app.debug') ? $e->getMessage() : 'Silakan coba lagi nanti'
            ], 500);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $stockOpname = StockOpname::find($id);
            if (!$stockOpname) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data stock opname tidak ditemukan',
                    'data' => []
                ], 404);
            }

            $stockOpname->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data stock opname berhasil dihapus',
                'data' => []
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    //cari data berdasarkan nama barang
    public function search(Request $request)
    {
        Carbon::setLocale('id');
        $validator = Validator::make($request->all(), [
            'query' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $query = trim(strtolower($request->input('query')));

        $results = StockOpname::all()->filter(function ($item) use ($query) {
            return str_contains(strtolower($item->nama_barang), $query);
        });

        $formatted = $results->map(function ($item) {
            return [
                'id' => $item->id,
                'nama_barang' => $item->nama_barang,
                'Jumlah' => $item->jumlah,
                'satuan' => $item->satuan,
                'Harga Satuan' => $item->harga,
                'jumlah' => $item->jumlah * $item->harga,
                'bulan' => optional($item->tanggal)->translatedFormat('F'),
                'tahun' => optional($item->tanggal)->format('Y'),
            ];
        });

        return response()->json([
            'success' => true,
            'message' => $formatted->isEmpty() ? 'Data tidak ditemukan' : 'Hasil pencarian',
            'data' => $formatted->values()
        ], 200);
    }

    // public function habis()
    // {
    //     DB::beginTransaction();
    //     try {
    //         $currentMonth = now()->format('m');
    //         $currentYear  = now()->format('Y');

    //         // Cek apakah sudah ada data pada bulan & tahun yang sama
    //         $alreadyExists = BarangHabis::whereMonth('tanggal', $currentMonth)
    //             ->whereYear('tanggal', $currentYear)
    //             ->exists();

    //         if ($alreadyExists) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Fungsi habis() sudah pernah dijalankan pada bulan ini',
    //                 'data'    => []
    //             ], 400);
    //         }

    //         // Ambil semua data stock_opname dengan jumlah == 0
    //         $stockOpname = StockOpname::where('jumlah', '=', 0)->get();

    //         if ($stockOpname->isEmpty()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Tidak ada data dengan jumlah 0',
    //                 'data'    => []
    //             ], 404);
    //         }

    //         foreach ($stockOpname as $item) {
    //             BarangHabis::create([
    //                 'nama_barang' => $item->nama_barang,
    //                 // 'tanggal'     => $item->tanggal,
    //                 'tanggal'     => now()->format('Y-m-d'),
    //             ]);
    //         }

    //         DB::commit();
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data stock opname berhasil dipindahkan ke BarangHabis',
    //             'data'    => $stockOpname
    //         ], 200);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Terjadi kesalahan saat memproses data',
    //             'error'   => $e->getMessage()
    //         ], 500);
    //     }
    // }


    // public function masih()
    // {
    //     DB::beginTransaction();
    //     try {
    //         // Cek apakah pada bulan ini sudah pernah dijalankan
    //         $currentMonth = now()->format('m');
    //         $currentYear = now()->format('Y');

    //         $alreadyExists = BarangMasih::whereMonth('tanggal', $currentMonth)
    //             ->whereYear('tanggal', $currentYear)
    //             ->exists();

    //         if ($alreadyExists) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Fungsi masih() sudah pernah dijalankan pada bulan ini',
    //                 'data' => []
    //             ], 400);
    //         }

    //         // Ambil semua data stock_opname dengan jumlah > 0
    //         $stockOpname = StockOpname::where('jumlah', '>', 0)->get();

    //         if ($stockOpname->isEmpty()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Tidak ada data dengan jumlah > 0',
    //                 'data' => []
    //             ], 404);
    //         }

    //         foreach ($stockOpname as $item) {
    //             // Simpan ke tabel barang_masih
    //             BarangMasih::create([
    //                 'nama_barang' => $item->nama_barang,
    //                 'jumlah'      => $item->jumlah,
    //                 'satuan'      => $item->satuan,
    //                 'tanggal'     => $item->tanggal,
    //             ]);

    //             // Update tanggal di stock_opname
    //             $item->update([
    //                 'tanggal' => now()->format('Y-m-d'),
    //             ]);
    //         }

    //         DB::commit();
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data berhasil dipindahkan ke BarangMasih dan tanggal StockOpname diperbarui',
    //             'data' => $stockOpname
    //         ], 200);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Terjadi kesalahan saat memproses data',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
}
