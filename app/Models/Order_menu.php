<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_menu extends Model
{
    use HasFactory;

    protected $fillable = ['no_transaksi', 'menu_id', 'price', 'creator', 'created_at', 'updated_at'];
}