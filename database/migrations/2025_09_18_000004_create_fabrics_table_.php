<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('fabrics', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Fabric type (cotton, denim, etc.)
            $table->string('color')->nullable();
            $table->decimal('quantity', 10, 2); // Numeric value
            $table->enum('unit', ['meters', 'yards', 'kgs']); // Measurement unit
            $table->string('supplier')->nullable(); // Optional supplier name
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('fabrics');
    }
};
