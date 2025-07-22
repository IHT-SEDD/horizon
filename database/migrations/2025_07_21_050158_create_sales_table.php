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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('quotation_number')->unique();

            $table->foreignId('customer_id')
                ->constrained('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('payment_term_id')
                ->constrained('payment_terms')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->decimal('untaxed_amount', 15, 2);
            $table->decimal('tax_amount', 15, 2)->nullable();
            $table->decimal('grand_total', 15, 2);

            $table->string('description')->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
