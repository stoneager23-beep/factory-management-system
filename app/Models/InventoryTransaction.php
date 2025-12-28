<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    use HasFactory;
    protected $table='inventory_transactions';
    protected $fillable = ['inventoryable_id','inventoryable_type','type','quantity','unit','unit_price','article_id','user_id','payment_method'];

    public function inventoryable()
    {
        return $this->morphTo();
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
