<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('production_steps', function (Blueprint $table) {
            $table->id();
           // $table->foreignId('article_id')->constrained()->cascadeOnDelete();
            $table->string('step');
            $table->json('meta')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->decimal('cost', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('production_steps');
    }
};
