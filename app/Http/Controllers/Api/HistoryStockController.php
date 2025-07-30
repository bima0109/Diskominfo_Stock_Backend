<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HistoryStock;

class HistoryStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $historyStock = HistoryStock::orderBy('tanggal', 'desc')->get();

            $formatted = $historyStock->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_barang' => $item->nama_barang,
                    'jumlah' => $item->jumlah,
                    'satuan' => $item->satuan,
                    'tanggal' => \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y'),
                    'created_at' => $item->created_at ? $item->created_at->toDateTimeString() : null,
                    'updated_at' => $item->updated_at ? $item->updated_at->toDateTimeString() : null,
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Data history stock berhasil ditampilkan',
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
