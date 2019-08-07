@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card bg-transparent border-0">
            <div class="row">
                @if (auth()->user()->type == 'cashier')
                <div class="col-md-3">
                    <a href="{{ route('kasir.index') }}">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fa fa-cash-register fa-4x"></i>
                                    <br>
                                    <br>
                                    <label >Cashier</label>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                
                @if (auth()->user()->type == 'waiter')
                    <div class="col-md-3">
                        <a href="{{ route('menus.index') }}">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fa fa-bars fa-4x"></i>
                                    <br>
                                    <br>
                                    <label >Menu List</label>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('orders.index') }}">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fa fa-envelope fa-4x"></i>
                                    <br>
                                    <br>
                                    <label>Pesanan</label>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif 

                @if (auth()->user()->type == 'owner')
                    <div class="col-md-3">
                        <a href="{{ route('accounts.index') }}">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fa fa-users fa-4x"></i>
                                    <br>
                                    <br>
                                    <label >Accounts</label>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('reports.index') }}">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fa fa-file fa-4x"></i>
                                    <br>
                                    <br>
                                    <label >Laporan</label>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection