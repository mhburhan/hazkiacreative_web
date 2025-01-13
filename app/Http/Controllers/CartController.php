<?php

// app/Http/Controllers/CartController.php
namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        // Ambil user yang sedang login
        $userId = Auth::id();

        // Cek apakah produk sudah ada di keranjang
        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            // Jika produk sudah ada, tingkatkan jumlahnya
            $cartItem->increment('quantity');
        } else {
            // Jika produk belum ada, tambahkan ke keranjang
            Cart::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'quantity' => 1,
            ]);
        }

        return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang!']);
    }

    public function index()
    {
        // Ambil keranjang dari database
        $userId = Auth::id();
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
        return view('carts.index', compact('cartItems'));
    }
}
