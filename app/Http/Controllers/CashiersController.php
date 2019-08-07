<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;
use App\Menu;
use App\Transaction;
use App\TransactionItem;

class CashiersController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $orders = Order::all();
        return view('cashiers.index', compact('orders'));
    }

    public function pilih()
    {
        $order = Order::where('table', request('table'))->first();
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        $totalAmount = rp($order->total);
        $items = [];
        foreach ($orderItems as $key) {
            $menu = Menu::find($key->menu_id);
            $items[] = [
                'menu' => $menu->name,
                'price' => rp($menu->price),
                'qty' => $key->qty,
                'amount' => rp($menu->price * $key->qty)
            ];
        }
        return response()->json(['order' => $order, 'orders' => $items, 'totalAmount' => $totalAmount]);
    }

    public function process()
    {
        // dd(request()->all());

        $transaction  = Transaction::create([
            'transaction_code' => uniqid(),
            'total' => request('total'),
            'pay' => request('bayar'),
            'change' => request('kembalian'),
            'user_id' => auth()->user()->id,
        ]);

        $transaction->update([
            'transaction_code' => 'RFT/' . date('m/d/') . strtoupper(uniqid()) . '/' . $transaction->id,
        ]);

        $order = Order::where('table', request('table'))->first();

        foreach ($order->orderItems as $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'menu' => Menu::find($item->menu_id)->name,
                'price' => Menu::find($item->menu_id)->price,
                'qty' => $item->qty,
                'amount' => Menu::find($item->menu_id)->price * $item->qty,
            ]);
        }

        $order->delete();


        return redirect()->route('kasir.bill', $transaction->id);

    }

    public function bill($bill)
    {
        $bill = Transaction::findOrFail($bill);
        return view('cashiers.bill', compact('bill'));
    }
}
