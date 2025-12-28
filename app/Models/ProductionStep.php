<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionStep extends Model
{
    use HasFactory;
protected $table='production_steps';
    protected $fillable = [
        'name',
        'sequence',
        'status',
        'is_active',
    ];

    // 🔗 Articles using this step
    public function articleSteps()
    {
        return $this->hasMany(ArticleProductionStep::class);
    }
}

//
//namespace App\Models;
//
//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
//
//class ProductionStep extends Model
//{
//    use HasFactory;
//
//    protected $fillable = ['article_id','step','meta','status','cost'];
//
//    protected $casts = ['meta' => 'array'];
//
//    public function article()
//    {
//        return $this->belongsTo(Article::class);
//    }
//}
