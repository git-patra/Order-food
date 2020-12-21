<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu_type;
use App\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::all();
        return response()->json([
            'menu' => $menu
        ]);
    }
    //
    public function store(Request $request)
    {
        Menu::create([
            'name' => $request->input('name'),
            'menu_type_id' => $request->input('menu_type_id'),
            'stock' => $request->input('stock'),
            'price' => $request->input('price'),
            'creator' => Auth::user()->name,
            'created_at' => now()
        ]);

        return redirect('/dashboard')->with('status', 'Successfully Added!');
    }

    //
    public function updateStock(Request $request)
    {
        $menu_id = $request->menuId;
        $stock = $request->stock;

        if (count($menu_id) >= 1) {
            for ($i = 0; $i < count($menu_id); $i++) {
                $menu = Menu::find($menu_id[$i]);

                Menu::where('id', $menu->id)
                    ->update([
                        'name' => $menu->name,
                        'menu_type_id' => $menu->menu_type_id,
                        'stock' => $stock[$i],
                        'creator' => $menu->creator,
                        'editor' => Auth::user()->name,
                        'updated_at' => now()
                    ]);
            }
        }

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