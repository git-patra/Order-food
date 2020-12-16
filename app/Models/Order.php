<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['no_transaksi', 'table_id', 'total_price', 'status', 'creator', 'editor', 'created_at', 'updated_at'];
}