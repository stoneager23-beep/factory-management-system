<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','phone','address'];


// A customer may have many inventory transactions
    public function transactions()
    {
        return $this->hasMany(InventoryTransaction::class);
    }
}
