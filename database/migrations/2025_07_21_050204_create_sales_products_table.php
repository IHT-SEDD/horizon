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
        Schema::create('sales_products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sales_id')
                ->constrained('sales')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('product_id')
                ->constrained('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('tax_id')->nullable()
                ->constrained('taxes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->bigInteger('discount')->default(0);
            $table->bigInteger('quantity')->default(0);
            $table->string('tags')->nullable();
            $table->bigInteger('subtotal')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_products');
    }
};
