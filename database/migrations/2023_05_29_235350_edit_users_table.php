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
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'first_name');
            $table->string('last_name')->after('name');
            $table->string('cpf')->after('last_name');
            $table->enum('gender', ['M', 'F', 'O'])->after('cpf');
            $table->string('phone')->after('gender');
            $table->date('birth_date')->nullable()->after('phone');
            $table->longText('remember_token')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('first_name', 'name');
            $table->dropColumn('last_name');
            $table->dropColumn('cpf');
            $table->dropColumn('gender');
            $table->dropColumn('phone');
            $table->dropColumn('birth_date');
            $table->string('remember_token')->change();
        });
    }
};
