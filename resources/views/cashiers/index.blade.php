@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('kasir.process') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nomor Meja</label>
                                <select name="table" id="table" class="custom-select" onchange="pilih()">
                                    <option value=""></option>
                                    @foreach ($orders->sortBy('table') as $order)                                    
                                        <option value="{{ $order->table }}">{{ $order->table }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Total</label>
                                <input type="number" name="total" id="total" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Bayar</label>
                                <input type="number" name="bayar" id="bayar" class="form-control" onkeyup="hitung()">
                            </div>
                            <div class="form-group">
                                <label>Kembalian</label>
                                <input type="number" name="kembalian" id="kembalian" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-striped">
                                <thead class="text-center">
                                    <th>Menu</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                </thead>
                                <tbody id="fildTable">
                                    {{-- <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr> --}}
                                </tbody>
                                <tfoot>
                                    <th colspan="3" class="text-right">Total</th>
                                    <th class="text-right" id="totalAmount"></th>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary" id="processBtn">Process</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function pilih() {
            $.ajax({
                type: "POST",
                url: "{{ route('kasir.pilih') }}",
                data: {
                    '_token' : "{{ csrf_token() }}",
                    'table' : $('#table').val(),
                },
                dataType: "JSON",
                success: function (response) {
                    $('#kembalian').val(''); $('#bayar').val(''); $('#total').val('');
                    $('#fildTable').html('');
                    $('#total').val(response.order.total);
                    $('#totalAmount').text(response.totalAmount);
                    (response.orders).forEach(element => {
                        $('#fildTable').append('<tr><td>' + element.menu + '</td><td>' + element.price + '</td><td>' + element.qty + '</td><td>' + element.amount + '</td></tr>');
                    });
                }, error: function (){
                    $('#kembalian').val(''); $('#bayar').val(''); $('#total').val('');
                    $('#fildTable').html('');
                    $('#totalAmount').text('');
                }
            });
        
        }

        $('#processBtn').hide();
        
        function hitung() {
            $('#kembalian').val($('#bayar').val() - $('#total').val());
            if ($('#kembalian').val() < 0) {
                $('#processBtn').hide();
            } else{
                $('#processBtn').show();
            }
        }

    </script>
@endsection