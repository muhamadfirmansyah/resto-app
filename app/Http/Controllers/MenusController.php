<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use Illuminate\Support\Facades\File;

class MenusController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $menus = Menu::where('name', 'LIKE', '%' . request('q') . '%')->get();
        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        return view('menus.create');
    }

    public function store()
    {
        $imageName = uniqid() . '-menu.' . request('photo')->getClientOriginalExtension();
        request('photo')->move(public_path('uploads/menus/'), $imageName);
        $imageName = 'uploads/menus/' . $imageName;

        Menu::create([
            'name' => request('name'),
            'photo' => $imageName,
            'description' => request('description'),
            'price' => request('price'),
            'category' => request('category'),
            'status' => request('status')
        ]);

        return redirect()->route('menus.index');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menus.edit', compact('menu'));
    }

    public function update($id)
    {
        $menu = Menu::findOrFail($id);
        $imageName = $menu->photo;
        if (request('photo')) {
            File::delete(public_path($menu->photo));
            $imageName = uniqid() . '-menu.' . request('photo')->getClientOriginalExtension();
            request('photo')->move(public_path('uploads/menus/'), $imageName);
            $imageName = 'uploads/menus/' . $imageName;
        }

        $menu->update([
            'name' => request('name'),
            'photo' => $imageName,
            'description' => request('description'),
            'price' => request('price'),
            'category' => request('category'),
            'status' => request('status')
        ]);

        return redirect()->route('menus.index')->with('Berhasil update');


    }

    public function delete()
    {
        Menu::findOrFail(request('id'))->delete();

        return redirect()->back()->with('message', 'Berhasil');
    }
}
