<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public function orderMenu()
    {
        return $this->hasMany('App\Models\Order_menu');
    }

    protected $fillable = ['name', 'menu_type_id', 'stock', 'price', 'creator', 'created_at', 'updated_at'];
}