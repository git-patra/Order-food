<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Order_menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function store(Request $request)
    {
        $menu_id = $request->menu;
        $totalPrice = 0;

        for ($i = 0; $i < count($menu_id); $i++) {
            $menu = Menu::find($menu_id[$i]);

            Order_menu::create([
                'no_transaksi' => $request->no_transaksi,
                'menu_id' => $menu->id,
                'price' => $menu->price,
                'creator' => $request->creator,
                'created_at' => $request->created_at,
                'updated_at' => $request->updated_at
            ]);

            $totalPrice += $menu->price;
        }

        Order::create([
            'no_transaksi' => $request->no_transaksi,
            'table_id' => $request->table_id,
            'total_price' => $totalPrice,
            'status' => $request->status,
            'creator' => $request->creator,
            'editor' => $request->editor,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at
        ]);

        return response()->json([
            'message' => 'Successfully added!'
        ], 200);
    }
}