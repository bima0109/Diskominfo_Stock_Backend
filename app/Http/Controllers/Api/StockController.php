<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HistoryStock;
use App\Models\StockOpname;
use App\Models\BarangHabis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
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
            // Cek dan pindahkan data dengan jumlah == 0 ke tabel barang_habis
            // $habis = StockOpname::where('jumlah', '=', 0)->get();
            // foreach ($habis as $item) {
            //     // Simpan ke tabel barang_habis
            //     BarangHabis::create([
            //         'nama_barang' => $item->nama_barang,
            //         'tanggal'     => $item->tanggal,
            //     ]);

            //     // Hapus dari stock_opname
            //     $item->delete();
            // }
            Carbon::setLocale('id');
            // Ambil semua data stock_opnames yang jumlahnya > 0
            $stockOpname = StockOpname::where('jumlah', '>', 0)->get();

            if ($stockOpname->count() > 0) {
                $formatted = $stockOpname->map(function ($item) {
                    return [
                        'id'            => $item->id,
                        'nama_barang'   => $item->nama_barang,
                        'Jumlah'        => $item->jumlah,
                        'satuan'        => $item->satuan,
                        'bulan'         => $item->tanggal->translatedFormat('F'),
                        'tahun'         => $item->tanggal->format('Y'),
                    ];
                });

                return response()->json([
                    'success' => true,
                    'message' => 'List semua data stock opname (jumlah > 0)',
                    'data'    => $formatted
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Data stock opname kosong',
                'data'    => []
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data',
                'error'   => $e->getMessage(),
                'trace'   => $e->getTrace(), // Bisa dihapus di production
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
                // 'harga' => 'required|numeric',
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
                // 'harga' => $stockOpname->harga,
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
                'id'            => $stockOpname->id,
                'nama_barang'   => $stockOpname->nama_barang,
                'Jumlah'        => $stockOpname->jumlah,
                'satuan'        => $stockOpname->satuan,
                // 'Harga Satuan'  => $stockOpname->harga,
                // 'jumlah'        => $stockOpname->jumlah * $stockOpname->harga,
                'bulan'         => $stockOpname->tanggal->format('F'),
                'tahun'         => $stockOpname->tanggal->format('Y'),
            ];

            return response()->json([
                'success' => true,
                'message' => 'Detail data stock opname',
                'data'    => $formatted
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data stock opname tidak ditemukan',
            'data'    => []
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
            ]);

            // Paksa tanggal menjadi now() saat update
            $validated['tanggal'] = now()->format('Y-m-d');

            $stockOpname->update($validated);

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
        $validator = Validator::make($request->all(), [
            'query' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $query = trim(strtolower($request->input('query')));

        $results = StockOpname::all()->filter(function ($item) use ($query) {
            return str_contains(strtolower($item->nama_barang), $query);
        });

        $formatted = $results->map(function ($item) {
            return [
                'id'            => $item->id,
                'nama_barang'   => $item->nama_barang,
                'Jumlah'        => $item->jumlah,
                'satuan'        => $item->satuan,
                // 'Harga Satuan'  => $item->harga,
                // 'jumlah'        => $item->jumlah * $item->harga,
                'bulan'         => optional($item->tanggal)->format('F'),
                'tahun'         => optional($item->tanggal)->format('Y'),
            ];
        });

        return response()->json([
            'success' => true,
            'message' => $formatted->isEmpty() ? 'Data tidak ditemukan' : 'Hasil pencarian',
            'data'    => $formatted->values()
        ], 200);
    }

    // public function habis()
    // {
    //     DB::beginTransaction();
    //     try {
    //         $stockOpname = StockOpname::where('jumlah', '=', 0)->get();
    //         foreach ($stockOpname as $item) {
    //             HistoryStock::create([
    //                 'nama_barang' => $item->nama_barang,
    //                 'tanggal' => $item->tanggal,

    //             ]);
    //             $item->delete();
    //         }
    //         DB::commit();
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data stock opname berhasil dipindahkan ke riwayat dan dihapus',
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
