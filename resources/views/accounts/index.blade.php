@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('accounts.create') }}" class="btn btn-light btn-md">+ Tambah</a>
                <br>
                <br>
                <table class="table table-striped">
                    <thead class="text-center">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($accounts as $account)
                            <tr>
                                <td>{{  $account->name }}</td>
                                <td class="text-center">{{$account->email}}</td>
                                <td class="text-center">{{title_case($account->type)}}</td>
                                <td class="text-center">
                                    <a href="{{ route('accounts.edit', $account->id ) }}" class="btn btn-sm btn-light shadow-sm">Edit</a>
                                    <form action="{{ route('accounts.delete', $account->id ) }}" class="d-inline" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger shadow-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
@endsection