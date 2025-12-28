<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabric extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'unit', 'unit_price', 'supplier', 'color'];

}
