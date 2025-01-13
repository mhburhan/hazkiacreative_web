<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
  

    public function index()
    {
        // Mengambil semua pesanan untuk pengguna yang sedang login
        $orders = Order::with('items.product')->get();
    
        // Debugging: Cek apakah data pesanan ada
        if ($orders->isEmpty()) {
            // Jika tidak ada pesanan, Anda bisa mengembalikan pesan atau melakukan tindakan lain
            return view('orders.index')->with('orders', $orders)->with('message', 'Tidak ada pesanan yang ditemukan.');
        }
    
        // Mengembalikan tampilan dengan data pesanan
        return view('orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id){
        $request->validate([
            'status' => 'required | in:pending,completed,canceled',
        ]);
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();
        return  response()->json(['message' => 'Status updated successfully.']);
    }
    
}