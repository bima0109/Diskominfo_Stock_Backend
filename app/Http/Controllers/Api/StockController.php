<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockOpname;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stockOpname = StockOpname::all();

        if ($stockOpname->count() > 0) {
            $formatted = $stockOpname->map(function ($item) {
                return [
                    'nama_barang'   => $item->nama_barang,
                    'Jumlah'        => $item->jumlah,
                    'satuan'        => $item->satuan,
                    'Harga Satuan'  => $item->harga,
                    'jumlah'        => $item->jumlah * $item->harga
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'List semua data stock opname',
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
                'harga' => 'required|numeric'
            ]);

            // Simpan ke database
            $stockOpname = StockOpname::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data stock opname berhasil ditambahkan',
                'data' => $stockOpname
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika validasi gagal
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()  // detail per field yang gagal
            ], 422);
        } catch (\Exception $e) {
            // Untuk error lainnya
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage() // hanya tampil jika debug aktif
            ], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stockOpname = StockOpname::find($id);
        if ($stockOpname) {
            return response()->json([
                'success' => true,
                'message' => 'Detail data stock opname',
                'data' => $stockOpname
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

            // Validasi input dengan pengecualian ID pada unique
            $validated = $request->validate([
                'nama_barang' => 'required|string|max:255|unique:stock_opnames,nama_barang,' . $id,
                'jumlah' => 'required|numeric', // jangan integer jika via form-data
                'satuan' => 'required|string|max:50',
                'harga' => 'required|numeric'
            ]);

            $stockOpname->update([
                'nama_barang' => $request->input('nama_barang'),
                'jumlah' => (int) $request->input('jumlah'),
                'satuan' => $request->input('satuan'),
                'harga' => (float) $request->input('harga')
            ]);


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
    }
}
