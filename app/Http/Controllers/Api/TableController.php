<?php

namespace App\Http\Controllers\Api;

use App\Models\Table;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{
    //

    public function store(Request $request)
    {
        Table::create([
            'no_table' => $request->no_table,
            'creator' => Auth::user()->name,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at
        ]);

        return redirect('/dashboard')->with('status', 'Successfully Added!');
    }
}