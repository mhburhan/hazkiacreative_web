<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class StatusOrderUser extends Controller
{

    public function index()
    {
        $orders = Order::with('items.product')->get();
        return view('carts.detail-pesanan-user', compact('orders'));
    }
}
