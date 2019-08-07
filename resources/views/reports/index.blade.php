@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('reports.index') }}" method="GET">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="date" name="start" class="form-control" required>
                                <small>{{ request('start') }}</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="date" name="end" class="form-control" required>
                                <small>{{ request('end') }}</small>
                            </div>
                        </div>
                        <div class="col">
                            <button class="btn btn-primary btn-md">Filter</button>
                            <a href="{{ route('reports.index') }}" class="btn btn-light btn-md">Reset</a>
                            {{-- <button class="btn btn-light btn-md"><i class="fa fa-print"></i></button> --}}
                        </div>
                    </div>
                </form>
                <hr>
                <br>
                <table class="table table-bordered">
                    <thead>
                        <th>Tanggal</th>
                        <th>Transaction Code</th>
                        <th>Items</th>
                        <th>Kasir</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                                <td>{{ $transaction->transaction_code }}</td>
                                <td>
                                    <ul style="list-style-type: none">
                                        @foreach ($transaction->transactionItems as $item)
                                            <li>- {{ $item->menu }} ({{ $item->qty }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $transaction->user->name }}</td>
                                {{-- <td>{{ rp($transaction->pay) }}</td> --}}
                                <td>{{ rp($transaction->total) }}</td>
                                {{-- <td>{{ rp($transaction->change) }}</td> --}}
                            </tr>
                        @endforeach
                        <tr class="bg-light font-weight-bold">
                            <td colspan="4">Pendapatan Keseluruhan</td>
                            <td>
                                {{ rp($transactions->sum('total')) }}    
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection