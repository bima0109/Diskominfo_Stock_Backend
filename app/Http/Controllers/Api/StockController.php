<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HistoryStock;
use App\Models\StockOpname;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data stock_opnames yang jumlahnya lebih dari 0
        $stockOpname = StockOpname::where('jumlah', '>', 0)->get();

        if ($stockOpname->count() > 0) {
            $formatted = $stockOpname->map(function ($item) {
                return [
                    'id'            => $item->id,
                    'nama_barang'   => $item->nama_barang,
                    'Jumlah'        => $item->jumlah,
                    'satuan'        => $item->satuan,
                    // 'Harga Satuan'  => $item->harga,
                    // 'jumlah'        => $item->jumlah * $item->harga,
                    'bulan'         => $item->tanggal->format('F'),
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
                'stock_opname_id' => $stockOpname->id,
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

            $validated = $request->validate([
                'nama_barang' => 'required|string|max:255|unique:stock_opnames,nama_barang,' . $id,
                'jumlah' => 'required|integer',
                'satuan' => 'required|string|max:50',
                // 'harga' => 'required|numeric',
                'tanggal' => 'nullable|date_format:Y-m-d',
            ]);

            //tanggal tidak diubah jika tidak ada input
            if (empty($validated['tanggal'])) {
                $validated['tanggal'] = $stockOpname->tanggal->format('Y-m-d');
            } else {
                $validated['tanggal'] = now()->format('Y-m-d');
            }

            $stockOpname->update($validated);

            $historyData = [
                'nama_barang' => $stockOpname->nama_barang,
                'jumlah' => $stockOpname->jumlah,
                'satuan' => $stockOpname->satuan,
                // 'harga' => $stockOpname->harga,
                'tanggal' => $stockOpname->tanggal,
            ];

            // update berdasarkan ID
            HistoryStock::where('stock_opname_id', $stockOpname->id)
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
}
