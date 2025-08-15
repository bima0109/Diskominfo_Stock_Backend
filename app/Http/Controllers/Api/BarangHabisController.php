<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangHabis;
use App\Models\BarangMasih;
use Carbon\Carbon;

class BarangHabisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexhabis()
    {
        try {
            $baranghabis = BarangHabis::orderBy('tanggal', 'desc')->get();

            $formatted = $baranghabis->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_barang' => $item->nama_barang,
                    'tanggal' => Carbon::parse($item->tanggal)->format('d-m-Y'),
                    'created_at' => $item->created_at ? $item->created_at->toDateTimeString() : null,
                    'updated_at' => $item->updated_at ? $item->updated_at->toDateTimeString() : null,
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Data Barang Habis berhasil ditampilkan',
                'total' => $formatted->count(),
                'data' => $formatted
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data',
                'error' => config('app.debug') ? $e->getMessage() : 'Silakan coba lagi nanti'
            ], 500);
        }
    }

    public function indexMasih()
    {
        try {
            $barangmasih = BarangMasih::orderBy('tanggal', 'desc')->get();

            $formatted = $barangmasih->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_barang' => $item->nama_barang,
                    'jumlah' => $item->jumlah,
                    'satuan' => $item->satuan,
                    'tanggal' => Carbon::parse($item->tanggal)->format('d-m-Y'),
                    'created_at' => $item->created_at ? $item->created_at->toDateTimeString() : null,
                    'updated_at' => $item->updated_at ? $item->updated_at->toDateTimeString() : null,
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Data Barang Masih berhasil ditampilkan',
                'total' => $formatted->count(),
                'data' => $formatted
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data',
                'error' => config('app.debug') ? $e->getMessage() : 'Silakan coba lagi nanti'
            ], 500);
        }
    }


    public function updateTanggalHabis(Request $request, $id)
    {
        try {
            $request->validate([
                'tanggal' => 'required|date_format:Y-m-d'
            ]);

            $barang = BarangHabis::findOrFail($id);
            $barang->tanggal = Carbon::parse($request->tanggal);
            $barang->save();

            return response()->json([
                'success' => true,
                'message' => 'Tanggal barang habis berhasil diperbarui',
                'data' => [
                    'id' => $barang->id,
                    'nama_barang' => $barang->nama_barang,
                    'tanggal' => $barang->tanggal->format('d-m-Y')
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui tanggal barang habis',
                'error' => config('app.debug') ? $e->getMessage() : 'Silakan coba lagi nanti'
            ], 500);
        }
    }

    public function updateTanggalMasih(Request $request, $id)
    {
        try {
            $request->validate([
                'tanggal' => 'required|date_format:Y-m-d'
            ]);

            $barang = BarangMasih::findOrFail($id);
            $barang->tanggal = Carbon::parse($request->tanggal);
            $barang->save();

            return response()->json([
                'success' => true,
                'message' => 'Tanggal barang masih berhasil diperbarui',
                'data' => [
                    'id' => $barang->id,
                    'nama_barang' => $barang->nama_barang,
                    'tanggal' => $barang->tanggal->format('d-m-Y')
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui tanggal barang masih',
                'error' => config('app.debug') ? $e->getMessage() : 'Silakan coba lagi nanti'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
