<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Order;
use App\OrderItem;

class CustomersController extends Controller
{
    public function index()
    {
        $menus = Menu::where('name', 'LIKE', '%' . request('q') . '%')->get();
        return view('customers.index', compact('menus'));
    }

    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return view('customers.show', compact('menu'));
    }

    public function addToCart()
    {
        $datas = session()->get('cart') ?? [];
        session()->forget('cart');

        foreach ($datas as $data) {
            if ($data['menu_id'] == request('menu_id')) {
                session()->push('cart', [
                    'menu_id' => $data['menu_id'],
                    'qty' => $data['qty'] + request('qty')
                ]);
                $ada = true;
            } else{
                session()->push('cart', [
                    'menu_id' => $data['menu_id'],
                    'qty' => $data['qty']
                ]);
            }
        }

        if (empty($ada)) {
            session()->push('cart', [
                'menu_id' => request('menu_id'),
                'qty' => request('qty')
            ]);
        }

        return response()->json(['message' => 'Berhasil menambahkan ke keranjang', 'jumlah' => count(session()->get('cart'))]);
    }

    public function cart()
    {
        $items = session()->get('cart') ?? [];
        $carts = [];
        foreach ($items as $item) {
            $carts[] = array_add(Menu::find($item['menu_id']), 'qty', $item['qty']);
        }

        $orders = Order::all();

        return view('customers.cart', compact('carts', 'orders'));
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back();
    }

    public function order()
    {
        $order = Order::where('table', request('table'))->first();
        if (empty($order)) {
            $order = Order::create([
                'table' => request('table'),
                'total' => request('total'),
                'note' => request('note')
            ]);
        }

        $order->update([
            'total' => $order->total + request('total')
        ]);

        $carts = session()->get('cart');
        foreach ($carts as $cart) {
            $amount = Menu::find($cart['menu_id'])->price * $cart['qty'];
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $cart['menu_id'], 
                'qty' => $cart['qty'], 
                'amount' => $amount
            ]);
        }

        session()->forget('cart');

        return view('customers.thanks', ['table' => request('table')]);
    }
}
