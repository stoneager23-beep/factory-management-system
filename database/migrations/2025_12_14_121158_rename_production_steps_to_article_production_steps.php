<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::rename('production_steps', 'article_production_steps');
    }

    public function down()
    {
        Schema::rename('article_production_steps', 'production_steps');
    }

};
