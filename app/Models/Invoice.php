<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
//        'article_id',
        'customer_id',
        'subtotal',
        'gst',
        'total',
        'with_gst',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

//#	Customer	Subtotal	GST	Total	Status	Actions
