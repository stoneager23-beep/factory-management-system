<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventoryable_id');
            $table->string('inventoryable_type');
            $table->enum('type', ['purchase', 'issue', 'adjustment']);
            $table->decimal('quantity', 12, 3);
            $table->string('unit');
            $table->decimal('unit_price', 12, 2)->nullable();
            $table->foreignId('article_id')->nullable()->constrained('articles')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('payment_method')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_transactions');
    }
};
