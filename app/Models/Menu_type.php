<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu_type extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'creator', 'created_at', 'updated_at'];
}