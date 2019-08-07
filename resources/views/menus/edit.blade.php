@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $menu->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Photo</label>
                                        <br>
                                        <img src="{{ asset($menu->photo) }}" alt="" style="width: 40px;">
                                        <br>
                                        <br>
                                        <input type="file" class="form-control" name="photo" id="photo">
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" class="form-control" name="price" id="price" required value="{{ $menu->price }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" required>{{ $menu->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category" id="category" class="custom-select" required>
                                            <option value=""></option>
                                            <option value="food" {{ $menu->category == 'food' ? 'selected' : '' }}>Food</option>
                                            <option value="drink" {{ $menu->category == 'drink' ? 'selected' : '' }}>Drink</option>
                                            <option value="dessert" {{ $menu->category == 'dessert' ? 'selected' : '' }}>Dessert</option>
                                            <option value="etc" {{ $menu->category == 'etc' ? 'selected' : '' }}>Etc</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="status" class="custom-select">
                                            <option value="available" {{ $menu->status == 'available' ? 'selected' : '' }}>Available</option>
                                            <option value="unavailable" {{ $menu->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-md btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection