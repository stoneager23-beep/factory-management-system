<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('accessories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Zip, Button, Thread, Lining
            $table->string('type')->nullable(); // e.g., Plastic, Brass, Jacket
            $table->string('color')->nullable();
            $table->decimal('quantity', 10, 2);
            $table->string('unit'); // meters, inches, kgs, grams
            $table->decimal('unit_price', 10, 2);
            $table->string('supplier')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('accessories');
    }
};
