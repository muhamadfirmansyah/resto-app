@extends('customers.layouts.app')

@section('content')
        <div class="row">
            <div class="col-lg-6">
                <figure>
                    <img class="product-big-img" src="{{ asset($menu->photo) }}" alt="" style="width: 100%;">
                </figure>
            </div>
            <div class="col-lg-6">
                <div class="product-content">
                    <h2>{{ title_case($menu->name) }}</h2>
                    <p>{{ $menu->description }}</p>
                    <div class="my-4 mb-5">
                            <div class="d-inline bg-light p-3 py-4">
                                <span>Qty :</span>
                                <select class="rounded-0 border-0 bg-light py-3 pl-4 text-right" id="qty">
                                    @for ($i = 1; $i < 25; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                    </div>
                    <a class="site-btn btn-line addBtn">ADD TO CART</a>
                </div>
            </div>
        </div>
@endsection

@section('script')
    <script src="{{ asset('customers/js/sweetalert2@8.js')}}"></script>
    <script>
        $('body').on('click', '.addBtn', function(){
            $.ajax({
                type: "POST",
                url: "{{ route('customers.addToCart') }}",
                data: {
                    '_token' : '{{ csrf_token() }}',
                    'qty' : $('#qty').val(),
                    'menu_id' : '{{ $menu->id }}'
                },
                dataType: "JSON",
                success: function (response) {
                    $('#jumlahCart').text(response.jumlah);
                    Swal.fire(
                        'Good job!',
                        response.message,
                        'success'
                    );
                }
            });
        });
    </script>
@endsection