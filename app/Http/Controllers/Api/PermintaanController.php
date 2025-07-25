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

        $permintaan->update($request->only([
            'jumlah',
            'keterangan',
        ]));

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
