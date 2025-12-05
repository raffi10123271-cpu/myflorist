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
    Schema::table('orders', function (Blueprint $table) {
        $table->foreignId('shipping_method_id')->nullable()->constrained('shipping_methods')->nullOnDelete();
        $table->integer('shipping_cost')->default(0);
        $table->string('shipping_status')->default('pending'); 
        // pending, processing, on_delivery, delivered
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
