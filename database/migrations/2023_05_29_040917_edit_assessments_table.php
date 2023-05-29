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
        Schema::table('assessments', function (Blueprint $table) {
            $table->renameColumn('assessments', 'assessments_user');
            $table->enum('assessments_product', ['1', '2', '3', '4', '5'])->after('assessments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->renameColumn('assessments_user', 'assessments');
            $table->dropColumn('assessments_product');
        });
    }
};
