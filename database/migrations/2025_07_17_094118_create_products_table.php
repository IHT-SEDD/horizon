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
            $table->string('name');
            $table->foreignId('product_category_id')
                ->constrained('product_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('type');
            $table->string('brand');
            $table->foreignId('product_unit_id')
                ->constrained('product_units')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('sales_price');
            $table->timestamps();
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
