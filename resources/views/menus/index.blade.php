@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('menus.create') }}" class="btn btn-light btn-md shadow-sm">+ Tambah</a>
                <br>
                <form action="{{ route('menus.index') }}" method="get">
                <div class="row pl-3 mt-4">
                    <input type="text" name="q" id="search" class="form-control col-md-6" placeholder="Cari ..." value="{{ request('q') }}"><button class="btn btn-primary btn-sm ml-2 px-4 shadow-sm"><i class="fa fa-search"></i></button>
                </div>
                </form>
                <br>
                <table class="table table-hover table-striped">
                    <thead>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{ $menu->name }}</td>
                                <td>{{ rp($menu->price) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-light shadow-sm" data-toggle="modal" data-target="#detail" data-description="{!! $menu->description !!}" data-image="{{ asset($menu->photo) }}" >See Detail</button>
                                    <a href="{{ route('menus.edit', $menu->id ) }}" class="btn btn-success btn-sm shadow-sm">Edit</a>
                                    <form action="{{ route('menus.delete') }}" style="display: inline;" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $menu->id }}">
                                        <button class="btn btn-danger btn-sm shadow-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal" id="detail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" alt="" id="photoPrev" style="width: 50%;">
                    <hr>
                    <h5>Description</h5>
                    <p id="descriptionPrev"></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            
            $('#detail').on('show.bs.modal', function(e){
                $('#photoPrev').attr('src', $(e.relatedTarget).data('image'));
                $('#descriptionPrev').text($(e.relatedTarget).data('description'));
            });

        })
    </script>
@endsection