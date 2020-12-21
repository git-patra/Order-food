<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Order_menu;
use App\Models\Table;
use App\Http\Controllers\Controller;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function store(Request $request)
    {
        $menu_id = $request->input('menu');
        $noTable = $request->no_table;
        $totalPrice = 0;

        $table = Table::find($noTable);
        $lastOrder = Order::latest()->first();

        // Kode transaksi
        $date = date("dmY");
        $num = 001;
        $noTransaksi = "ABC$date" . str_pad($num, 3, "0", STR_PAD_LEFT);

        function noTransaksi($noTransaksi, $lastOrder)
        {
            if (isset($lastOrder)) {
                if ($noTransaksi !== $lastOrder->no_transaksi || $noTransaksi === $lastOrder->no_transaksi) {
                    $noBaru = $lastOrder->no_transaksi;
                    list($mem_prefix, $mem_num) = sscanf($noBaru, "%[A-Za-z]%[0-9]");

                    return $mem_prefix . str_pad($mem_num + 1, 3, '0', STR_PAD_LEFT);
                } else {
                    return $noTransaksi;
                }
            } else {
                return $noTransaksi;
            }
        }
        $noTransaksi = noTransaksi($noTransaksi, $lastOrder);

        if (count($menu_id) >= 1) {
            for ($i = 0; $i < count($menu_id); $i++) {
                $menu = Menu::find($menu_id[$i]);

                Order_menu::create([
                    'no_transaksi' => $noTransaksi,
                    'menu_id' => $menu->id,
                    'price' => $menu->price,
                    'creator' => Auth::user()->name,
                    'created_at' => now()
                ]);

                Menu::where('id', $menu->id)
                    ->update([
                        'name' => $menu->name,
                        'menu_type_id' => $menu->menu_type_id,
                        'stock' => $menu->stock - 1,
                        'creator' => $menu->creator,
                        'editor' => Auth::user()->name,
                        'updated_at' => now()
                    ]);

                $totalPrice += $menu->price;
            }
        }

        Order::create([
            'no_transaksi' => $noTransaksi,
            'table_id' => $noTable,
            'total_price' => $totalPrice,
            'status' => 1,
            'creator' => Auth::user()->name,
            'editor' => $request->editor,
            'created_at' => now()
        ]);

        Table::where('id', $table->id)
            ->update([
                'no_table' => $table->no_table,
                'status' => 1,
                'creator' => $table->creator,
                'editor' => Auth::user()->name,
                'updated_at' => now()
            ]);

        return redirect('/dashboard')->with('status', 'Successfully Added!');
    }

    // Konfirm
    public function konfirm($id)
    {
        $order = Order::find($id);
        $table = Table::find($order->table_id);

        Order::where('id', $id)
            ->update([
                'no_transaksi' => $order->no_transaksi,
                'table_id' => $order->table_id,
                'total_price' => $order->total_price,
                'status' => 0,
                'creator' => $order->creator,
                'editor' => Auth::user()->name,
                'updated_at' => now()
            ]);

        Table::where('id', $table->id)
            ->update([
                'no_table' => $table->no_table,
                'status' => 0,
                'creator' => $order->creator,
                'editor' => Auth::user()->name,
                'updated_at' => now()
            ]);

        return redirect('/dashboard')->with('status', 'Successfully Added!');
    }
}