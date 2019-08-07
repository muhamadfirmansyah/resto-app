<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;

class OrdersController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function update()
    {
        OrderItem::find(request('id'))->update([
            'status' => request('status')
        ]);

        return response()->json(['id' => request('id'), 'status' => title_case(request('status'))]);
    }
}
