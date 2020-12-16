<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu_type;
use App\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    //
    public function store(Request $request)
    {
        Menu::create([
            'name' => $request->name,
            'menu_type_id' => $request->menu_type_id,
            'stock' => $request->stock,
            'price' => $request->price,
            'creator' => Auth::user()->name,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at
        ]);

        return redirect('/dashboard')->with('status', 'Successfully Added!');
    }

    //
    public function storeType(Request $request)
    {
        Menu_type::create([
            'name' => $request->type,
            'creator' => Auth::user()->name,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at
        ]);

        return redirect('/dashboard')->with('status', 'Successfully Added!');
    }
}