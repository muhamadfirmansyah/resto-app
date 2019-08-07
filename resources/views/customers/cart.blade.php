@extends('customers.layouts.app')

@section('content')
<div class="cart-table">
        <table>
            <thead>
                <tr>
                    <th class="product-th">Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th class="total-th">Total</th>
                </tr>
            </thead>
            <tbody>
                @if (count($carts) < 1)
                    <tr>
                        <td class="text-center" colspan="4">No Data</td>
                    </tr>
                @endif
                @php
                    $total = 0;
                @endphp
                @foreach ($carts as $cart)
                    <tr>
                        <td class="product-col">
                            <img src="{{ asset($cart->photo) }}" alt="">
                            <div class="pc-title">
                                <h4>{{ $cart->name }}</h4>
                            </div>
                        </td>
                        <td class="price-col">{{ rp($cart->price) }}</td>
                        <td class="text-center">
                            {{ $cart->qty }}
                        </td>
                        {{-- <td class="quy-col">
                            <div class="quy-input">
                                <span>Qty</span>
                                <select class="rounded-0 border-0 bg-transparent pl-4 text-right" id="qty">
                                    @for ($i = 1; $i < 25; $i++)
                                        <option value="{{ $i }}" {{ $i == $cart->qty ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </td> --}}
                        @php
                            $total += $cart->price * $cart->qty;
                        @endphp
                        <td class="total-col">{{ rp($cart->price * $cart->qty) }}</td>
                    </tr>
                @endforeach
                @if (!count($carts) < 1)
                    <tr>
                        <td colspan="3" class="text-center">Total</td>
                        <td class="text-center">{{ rp($total) }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-lg-7 col-md-7 text-lg-right text-left offset-5">
            <a href="{{ route('customers.clearCart') }}" class="site-btn btn-line btn-update">Clear Cart</a>
        </div>
    </div>
    <div class="container mt-4">
        <hr>
        <form action="{{ route('customers.order') }}" method="POST">
            @csrf
            <input type="hidden" name="total" value="{{ $total }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                            <label class="col-md-3 col-form-label">Nomor Meja*</label>
                            <select name="table" id="table" class="col-md-9 custom-select" required>
                                <option value=""></option>
                                @for ($i = 1; $i < 30; $i++)
                                    <option value="{{ $i }}"
                                    {{-- @foreach ($orders as $order)
                                        {{ $order->table == $i ? 'disabled' : '' }}
                                    @endforeach --}}
                                    >{{ $i }}</option>                            
                                @endfor
                            </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Beri Catatan?</label>
                        <textarea name="note" id="note" cols="30" rows="10" class="form-control col-md-9" placeholder="contoh: tidak menggunakan lada"></textarea>
                    </div>
                    <div class="row cart-buttons">
                        <div class="col-md-5">
                            @if (session()->has('cart'))
                                <button class="site-btn btn-continue">Lanjut Pemesanan</button>
                            @else
                                <div class="site-btn btn-continue bg-light text-secondary">Lanjut Pemesanan</div> 
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection