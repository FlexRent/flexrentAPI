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
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('price', 'daily_price');
            $table->decimal('product_price')->after('price');
            $table->renameColumn('withdrawal_week', 'custom_time_from');
            $table->renameColumn('delivery_week', 'custom_time_until');
            $table->boolean('any_time')->before('custom_time_from');
            $table->enum('rent_day', ['ever_day', 'weekday', 'weekend'])->nullable()->after('delivery_week');
            $table->dropColumn('weekend_withdrawal');
            $table->dropColumn('weekend_delivery');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('daily_price', 'price');
            $table->dropColumn('product_price');
            $table->dropColumn('any_time');
            $table->renameColumn('custom_time_from', 'withdrawal_week');
            $table->renameColumn('custom_time_until', 'delivery_week');
            $table->time('weekend_withdrawal', 6)->nullable();
            $table->time('weekend_delivery', 6)->nullable();
            $table->dropColumn('rent_day');
        });
    }
};
