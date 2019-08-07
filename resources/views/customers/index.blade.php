@extends('customers.layouts.app')

@section('content')
    <div class="row">
        {{-- <div class="col-lg-3">
            <div class="product-item">
                <figure>
                    <img src="customers/img/products/1.jpg" alt="">
                    <div class="pi-meta">
                        <div class="pi-m-left">
                            <img src="customers/img/icons/eye.png" alt="">
                            <p>quick view</p>
                        </div>
                        <div class="pi-m-right">
                            <img src="customers/img/icons/heart.png" alt="">
                            <p>save</p>
                        </div>
                    </div>
                </figure>
                <div class="product-info">
                    <h6>Long red Shirt</h6>
                    <p>$39.90</p>
                    <a href="#" class="site-btn btn-line">ADD TO CART</a>
                </div>
            </div>
        </div> --}}
        <div class="col-md-12 mb-5 mt-4">
            <div class="row">
                <div class="col">
                    <form action="{{ route('customers.index') }}" method="GET">
                        <input type="text" class="form-control shadow border-0" name="q" value="{{ request('q') }}">
                    </form>
                </div>
            </div>
        </div>
        @foreach ($menus as $menu)
            <div class="col-lg-3">
                <a href="{{ route('customers.show', $menu->id ) }}">
                    <div class="product-item shadow p-2">
                        <figure>
                            <img src="{{ asset($menu->photo) }}" alt="">
                            {{-- <div class="bache">NEW</div> --}}
                            <div class="pi-meta">
                                <div class="container text-white">
                                    {{ str_limit($menu->description, 50) }}
                                </div>
                            </div>
                        </figure>
                        <div class="product-info">
                            <h6>{{ title_case($menu->name) }}</h6>
                            <p>{{ rp($menu->price) }}</p>
                            <a class="site-btn btn-line addBtn" data-id="{{ $menu->id }}">ADD TO CART</a>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
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
                    'qty' : '1',
                    'menu_id' : $(this).data('id')
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