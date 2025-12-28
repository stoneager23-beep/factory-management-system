<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('article_production_steps', function (Blueprint $table) {

            // Primary Key
            $table->id();

            // Relations
            $table->foreignId('article_id')
                ->constrained('articles')
                ->cascadeOnDelete();

            $table->string('step_name');
            // e.g Cutting, Stitching, Finishing, Packing

            // Production quantities
            $table->integer('input_qty')->default(0);
            $table->integer('output_qty')->default(0);

            // Cost per unit for this step
            $table->decimal('cost', 12, 2)->default(0);

            // Quality Control
            $table->integer('checked_qty')->default(0);
            $table->integer('defected_qty')->default(0);

            // B-grade recovery
            $table->decimal('b_grade_price', 12, 2)->default(0);

            // Remarks / defect reason
            $table->string('remarks')->nullable();

            // Status
            $table->enum('status', ['pending', 'in_progress', 'completed'])
                ->default('pending');

            // Audit fields
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_production_steps');
    }
};
