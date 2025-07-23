<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permintaan = Permintaan::with(['user', 'bidang', 'stockOpname'])->get();

        if ($permintaan->count() > 0) {
            return response()->json([
                'success' => true,
                'message' => 'List semua data permintaan',
                'data'    => $permintaan
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data permintaan kosong',
            'data'    => []
        ], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:500',
            'tanggal' => 'required|date',
            'status' => 'required|in:pending,approved,rejected',
            'id_stock_opname' => 'required|exists:stock_opnames,id',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
        ]);

        $user = Auth::user();

        $permintaan = Permintaan::create([
            'nama_barang' => $request->nama_barang,
            'keterangan' => $request->keterangan ?? '-',
            'tanggal' => $request->tanggal ?? now(),
            'status' => $request->status ?? 'pending',
            'id_user' => $user->id,
            'id_bidang' => $user->id_bidang,
            'id_stock_opname' => $request->id_stock_opname,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permintaan berhasil dibuat',
            'data'    => $permintaan
        ], 201);
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
