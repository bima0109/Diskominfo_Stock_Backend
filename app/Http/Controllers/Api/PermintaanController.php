<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;
use App\Models\StockOpname;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $permintaan = Permintaan::find($id);
        if (!$permintaan) {
            return response()->json([
                'message' => 'Permintaan not found'
            ], 404);
        }

        $jumlahLama = $permintaan->jumlah;


        $request->validate([
            'jumlah' => 'required|integer',
            'keterangan' => 'nullable|string',
        ]);

        $jumlahBaru = $request->input('jumlah');


        $selisih = $jumlahBaru - $jumlahLama;


        $stockOpname = StockOpname::find($permintaan->kode_barang);
        if (!$stockOpname) {
            return response()->json([
                'message' => 'Stock Opname tidak ditemukan berdasarkan kode_barang'
            ], 404);
        }


        $stockOpname->jumlah -= $selisih;
        if ($stockOpname->jumlah < 0) {
            return response()->json([
                'message' => 'Stok tidak mencukupi untuk perubahan ini'
            ], 422);
        }
        $stockOpname->save();


        $permintaan->update($request->only(['jumlah', 'keterangan']));

        return response()->json([
            'message' => 'Permintaan updated successfully',
            'data' => $permintaan
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $permintaan = Permintaan::find($id);
        if (!$permintaan) {
            return response()->json([
                'message' => 'Permintaan not found'
            ], 404);
        }

        $permintaan->delete();

        return response()->json([
            'message' => 'Permintaan deleted successfully'
        ]);
    }
}
