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
            $table->string('quotation_number')->unique()->nullable();

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

            $table->bigInteger('untaxed_amount')->default(0);
            $table->bigInteger('tax_amount')->default(0);
            $table->bigInteger('grand_total')->default(0);

            $table->string('description')->nullable();
            $table->date('expiration_date');
            $table->string('status')->nullable();
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
