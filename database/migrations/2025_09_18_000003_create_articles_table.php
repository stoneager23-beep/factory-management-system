<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('article_number')->unique();
         //   $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('status')->default('in_progress');
            $table->decimal('total_cost', 12, 2)->default(0);
            $table->decimal('total_price', 12, 2)->default(0);
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('articles');
    }
};
