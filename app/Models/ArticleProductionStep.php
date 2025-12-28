<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleProductionStep extends Model
{
    use HasFactory;

    protected $table = 'article_production_steps';


       protected $fillable = [
           'article_id',
           'step_name',
           'input_qty',
           'output_qty',
           'cost',
           'checked_qty',
           'defected_qty',
           'b_grade_price',
           'remarks',
           'status',
       ];



    protected $casts = [
        'meta' => 'array',
    ];

    // 🔗 Parent Article
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    // 🔗 Master step
    public function productionStep()
    {
        return $this->belongsTo(ProductionStep::class);
    }
}
