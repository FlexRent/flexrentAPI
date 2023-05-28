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
        Schema::table('cards', function (Blueprint $table) {
            $table->string('card_number')->change();
            $table->string('due_date')->change();
            $table->renameColumn('cvv', 'card_cvv');
            $table->renameColumn('due_date', 'card_expiration_date');
            $table->string('card_title');
            $table->string('card_name');
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->integer('card_number')->change();
            $table->date('due_date')->change();
            $table->renameColumn('card_cvv', 'cvv');
            $table->renameColumn('card_expiration_date', 'due_date');
            $table->dropColumn('card_title');
            $table->dropColumn('card_name');
            $table->dropColumn('user_id');
        });
    }
};
