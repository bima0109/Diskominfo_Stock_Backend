<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart; // Assuming you have a Cart model
use PhpParser\Node\Stmt\Catch_;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            }

            $cartItems = Cart::where('user_id', $user->id)->with('stockOpname')->get();

            foreach ($cartItems as $cart) {
                if ($cart->stockOpname && $cart->stockOpname->jumlah < 0) {
                    $cart->delete();
                }
            }

            $updatedCarts = Cart::where('user_id', $user->id)->with('stockOpname')->get();

            return response()->json([
                'message' => 'Data cart berhasil diambil',
                'data' => $updatedCarts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil data cart',
                'error' => $e->getMessage()
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
