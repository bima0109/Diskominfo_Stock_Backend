<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use PhpParser\Node\Stmt\Catch_;
use App\Models\StockOpname;

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

            $cartItems = Cart::where('id_user', $user->id)->with('stockOpname')->get();

            foreach ($cartItems as $cart) {
                if ($cart->stockOpname && $cart->stockOpname->jumlah < 0) {
                    $cart->delete();
                }
            }

            $updatedCarts = Cart::where('id_user', $user->id)->with('stockOpname')->get();

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

    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            }

            // Validasi input
            $validatedData = $request->validate([
                'id_stock_opname' => 'required|exists:stock_opnames,id',
                'jumlah' => 'required|integer|min:1',
            ]);

            // Ambil data stok yang dimaksud
            $stock = StockOpname::find($validatedData['id_stock_opname']);
            if (!$stock || $stock->jumlah < $validatedData['jumlah']) {
                return response()->json([
                    'message' => 'Stok tidak mencukupi atau tidak ditemukan'
                ], 400);
            }

            // Buat cart baru
            $cart = Cart::create([
                'id_user' => $user->id,
                'id_stock_opname' => $validatedData['id_stock_opname'],
                'jumlah' => $validatedData['jumlah'],
            ]);

            return response()->json([
                'message' => 'Item berhasil ditambahkan ke cart',
                'data' => $cart
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menambahkan item ke cart',
                'error' => $e->getMessage()
            ], 500);
        }
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
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            }

            // Validasi input jumlah
            $validatedData = $request->validate([
                'jumlah' => 'required|integer|min:1',
            ]);

            $cart = Cart::where('id', $id)->where('id_user', $user->id)->first();
            if (!$cart) {
                return response()->json([
                    'message' => 'Item cart tidak ditemukan'
                ], 404);
            }

            // Cek apakah jumlah baru tersedia di stok
            $stock = StockOpname::find($cart->id_stock_opname);
            if (!$stock || $stock->jumlah < $validatedData['jumlah']) {
                return response()->json([
                    'message' => 'Jumlah melebihi stok yang tersedia'
                ], 400);
            }

            $cart->jumlah = $validatedData['jumlah'];
            $cart->save();

            return response()->json([
                'message' => 'Jumlah cart berhasil diperbarui',
                'data' => $cart
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengupdate cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            }

            $cart = Cart::where('id', $id)->where('id_user', $user->id)->first();
            if (!$cart) {
                return response()->json([
                    'message' => 'Item cart tidak ditemukan'
                ], 404);
            }

            $cart->delete();

            return response()->json([
                'message' => 'Item berhasil dihapus dari cart'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus item dari cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
