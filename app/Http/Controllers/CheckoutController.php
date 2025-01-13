<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart; // Model untuk keranjang
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
       
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:500',
            'payment_method' => 'required|string',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        // Ambil item keranjang untuk pengguna yang sedang login
        $cartItems = Cart::where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('products.index')->with('error', 'Keranjang Anda kosong.');
        }

        // Hitung total dari keranjang
        $totalAmount = 0;

        $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Simpan pesanan
        $order = Order::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'payment_method' => $validatedData['payment_method'],
            'payment_proof' => $paymentProofPath,
            'user_id' => Auth::id(),    
        ]);

        // Simpan item pesanan
        foreach ($cartItems as $item) {
            $totalAmount += $item->product->price * $item->quantity; // Mengasumsikan relasi antara Cart dan Product

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Update total amount pesanan
        $order->total_amount = $totalAmount;
        $order->save();

        // Hapus item keranjang setelah pemesanan
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('checkout.complete')->with('success', 'Pesanan Anda telah diproses!');
    }

    public function complete()
    {
        return view('checkout.complete'); // Halaman konfirmasi
    }
}