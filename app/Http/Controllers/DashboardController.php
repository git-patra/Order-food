<?php

use App\Models\Table;

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Menu;
use App\Models\Menu_type;
use App\Models\Order;
use App\Models\Order_menu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tables = Table::all();
        $menus = Menu::all();
        $menuTypes = Menu_type::all();
        $orders = Order::all();
        $order_menus = Order_menu::all();

        return view('dashboard', [
            'tables' => $tables,
            'menus' => $menus,
            'menuTypes' => $menuTypes,
            'order_menus' => $order_menus,
            'orders' => $orders
        ]);
    }
}