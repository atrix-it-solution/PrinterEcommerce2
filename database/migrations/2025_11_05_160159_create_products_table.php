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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('featured_image')->nullable();
            $table->decimal('regular_price')->nullable();
            $table->decimal('sale_price')->nullable();
            $table->string('sku', 100)->unique()->nullable();
            $table->integer('stock_quantity')->nullable()->default(null); 

            $table->timestamps();

            $table->foreign('featured_image')->references('id')->on('media')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
