@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Photo</label>
                                        <input type="file" class="form-control" name="photo" id="photo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" class="form-control" name="price" id="price" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category" id="category" class="custom-select" required>
                                            <option value=""></option>
                                            <option value="food">Food</option>
                                            <option value="drink">Drink</option>
                                            <option value="dessert">Dessert</option>
                                            <option value="etc">Etc</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="status" class="custom-select">
                                            <option value="available">Available</option>
                                            <option value="unavailable">Unavailable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-md btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection