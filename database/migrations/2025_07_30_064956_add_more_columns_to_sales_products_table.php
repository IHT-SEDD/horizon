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
        Schema::table('sales_products', function (Blueprint $table) {
            $table->bigInteger('delivered_qty')->default(0)->after('quantity');
            $table->bigInteger('invoiced_qty')->default(0)->after('delivered_qty');
            $table->date('deliver_date')->nullable()->after('subtotal');
            $table->date('invoice_date')->nullable()->after('deliver_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales_products', function (Blueprint $table) {
            $table->dropColumn('delivered_qty');
            $table->dropColumn('invoiced_qty');
            $table->dropColumn('deliver_date');
            $table->dropColumn('invoice_date');
        });
    }
};
