<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'payment'])->get(); // Charge les relations user et payment
        return view('admin.orders', compact('orders'));
    }
}
