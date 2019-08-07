@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @foreach ($orders as $order)                    
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <table class="table table-striped">
                                <tr>
                                    <td colspan="4"><h2>Table {{ $order->table }}</h2></td>
                                </tr>
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->menu->name }}</td>
                                        <td style="width: 30%;" class="status">{{ title_case($item->status) }}</td>
                                        <td class="text-center" style="width: 20%;">{{ $item->qty }}</td>
                                        <td class="text-center" style="width: 20%;">
                                            @if ($item->status == "new")
                                                <button class="btn btn-success btn-sm w-100" id="processBtn" data-id="{{ $item->id }}">Process</button>
                                            @elseif($item->status == "processed")
                                                <button class="btn btn-warning btn-sm w-100" id="servedBtn" data-id="{{ $item->id }}">Served</button>
                                            @else
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">
                                        Note : {{ $order->note }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>    
@endsection

@section('script')
    <script>
        
        $('body').on('click', '#processBtn', function(e){
             $.ajax({
                 type: "POST",
                 url: "{{ route('orders.update') }}",
                 data: {
                     '_token' : '{{ csrf_token() }}',
                     'id' : $(this).data('id'),
                     'status' : 'processed'
                 },
                 dataType: "JSON",
                 success: function (response) {
                     $(e.currentTarget).closest('tr').find('.status').text(response.status);
                    var button = '<button class="btn btn-warning btn-sm w-100" id="servedBtn" data-id="' + response.id + '">Served</button>';
                    $(e.currentTarget).closest('td').html(button);
                 }
             });
        });

        $('body').on('click', '#servedBtn', function(e){
             $.ajax({
                 type: "POST",
                 url: "{{ route('orders.update') }}",
                 data: {
                     '_token' : '{{ csrf_token() }}',
                     'id' : $(this).data('id'),
                     'status' : 'served'
                 },
                 dataType: "JSON",
                 success: function (response) {
                    $(e.currentTarget).closest('tr').find('.status').text(response.status);
                    var cek = '<i class="fa fa-check"></i>';
                    $(e.currentTarget).closest('td').html(cek);
                 }
             });
        });
        
    </script>
@endsection