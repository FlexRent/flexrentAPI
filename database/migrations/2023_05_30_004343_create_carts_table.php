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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->date('dt_withdrawal'); //dt_retirada
            $table->date('dt_delivery'); //dt_entrega
            $table->integer('daily'); //diaria
            $table->decimal('vl_safe', 8,2); //vl_seguro
            $table->decimal('vl_guarantee', 8,2); //vl_caução
            $table->decimal('vl_total', 8,2); //vl_total
            $table->integer('user_id');
            $table->integer('product_id');
            $table->integer('address_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
