<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('invoice_number')->unique();
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('gst', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->boolean('with_gst')->default(false);
            $table->string('status')->default('pending_approval');

            $table->timestamps();
        });

        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('invoice_id')
                ->constrained('invoices')
                ->cascadeOnDelete();

            $table->foreignId('article_id')
                ->constrained('articles')
                ->cascadeOnDelete();

            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total', 10, 2);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice_items');
        Schema::dropIfExists('invoices');
    }
};

//
//use Illuminate\Database\Migrations\Migration;
//use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Support\Facades\Schema;
//
//return new class extends Migration
//{
//    public function up()
//    {
//        Schema::create('invoices', function (Blueprint $table) {
//            $table->id();
//
//            $table->foreignId('customer_id')
//                ->constrained('customers')
//                ->cascadeOnDelete();
//
//            $table->decimal('subtotal', 10, 2)->default(0);
//            $table->decimal('gst', 10, 2)->default(0);
//            $table->decimal('total', 10, 2)->default(0);
//            $table->boolean('with_gst')->default(false);
//            $table->string('status')->default('pending_approval');
//
//            $table->timestamps();
//
//
//
//
//    });
//        Schema::create('invoice_items', function (Blueprint $table) {
//            $table->id();
//            $table->foreignId('invoice_id')->constrained()->cascadeOnDelete();
//            $table->foreignId('article_id')->constrained()->cascadeOnDelete();
//            $table->integer('quantity');
//            $table->decimal('unit_price', 10, 2);
//            $table->decimal('total', 10, 2);
//            $table->timestamps();
//        });
//
////        Schema::create('invoice_items', function (Blueprint $table) {
////            $table->id();
////           // $table->foreignId('invoice_id')->constrained()->cascadeOnDelete();
////            $table->string('description');
////            $table->decimal('qty', 12, 2)->default(1);
////            $table->decimal('unit_price', 12, 2)->default(0);
////            $table->decimal('total', 12, 2)->default(0);
////            $table->timestamps();
////        });
//    }
//
//    public function down()
//    {
//        Schema::dropIfExists('invoice_items');
//        Schema::dropIfExists('invoices');
//    }
//};
