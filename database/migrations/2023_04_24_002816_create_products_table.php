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
            $table->string('description');
            $table->string('model');
            $table->decimal('price', 8, 2);
            $table->string('image');
            $table->enum('status', ['available', 'negotiation', 'rented']);
            $table->dateTime('withdrawal_week', $precision = 0);
            $table->dateTime('delivery_week', $precision = 0);
            $table->dateTime('weekend_withdrawal', $precision = 0);
            $table->dateTime('weekend_delivery', $precision = 0);
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
