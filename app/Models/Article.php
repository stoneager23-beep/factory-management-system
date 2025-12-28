<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_number',
        'customer_id',
       // 'article_id',
        'status',
        'total_cost',
        'total_price',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    // 🔗 Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // 🔗 Production steps for this article
    public function productionSteps()
    {
        return $this->hasMany(ArticleProductionStep::class);
    }

    // 🔗 Inventory movements (already in your system)
    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class);
    }

    // 🔗 Invoice (one article → one invoice)
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}

//
//namespace App\Models;
//
//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
//
//class Article extends Model
//{
//    use HasFactory;
//
//    protected $fillable = [
//        'article_number', 'customer_id', 'status', 'total_cost', 'total_price', 'meta'
//    ];
//
//    protected $casts = [
//        'meta' => 'array'
//    ];
//
//    public function customer()
//    {
//        return $this->belongsTo(Customer::class);
//    }
//
//    public function productionSteps()
//    {
//        return $this->hasMany(ProductionStep::class);
//    }
//
//    public function inventoryTransactions()
//    {
//        return $this->hasMany(InventoryTransaction::class);
//    }
//
//    public function invoice()
//    {
//        return $this->hasOne(Invoice::class);
//    }
//}
