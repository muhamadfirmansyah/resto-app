<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class AccountsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $accounts = User::all();
        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(Request $data)
    {
        $this->validate($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'type'  => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'type'  => $data['type'],
            'password' => Hash::make($data['password']),
        ]); 

        return redirect()->route('accounts.index');
    }

    public function edit($id)
    {
        $account  = User::findOrFail($id);
        return view('accounts.edit', compact('account'));
    }

    public function update(Request $data, $id)
    {
        $account = User::findOrFail($id);
        if($account->email != $data['email']){
            $account->update([
                'email' => $data['email']
            ]);
        }
        $account->update([
            'name' => $data['name'],
            'type'  => $data['type'],
        ]);

        if (!empty($data['password'])) {
            $account->update([
                'password' => Hash::make($data['password']),
            ]);
        }

        return redirect()->route('accounts.index');
    }

    public function delete()
    {
        User::findOrFail(request('id'))->delete();

        return redirect()->back();
    }
}
