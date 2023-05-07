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
            $table->string('description')->nullable();
            $table->string('model')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['available', 'negotiation', 'rented'])->nullable();
            $table->dateTime('withdrawal_week', $precision = 0)->nullable();
            $table->dateTime('delivery_week', $precision = 0)->nullable();
            $table->dateTime('weekend_withdrawal', $precision = 0)->nullable();
            $table->dateTime('weekend_delivery', $precision = 0)->nullable();
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
