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
        Schema::table('personals', function (Blueprint $table) {
            $table->string('cedula')->change(); // Cambia el tipo a string
            $table->unique('cedula'); // Agrega la restricción unique
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personals', function (Blueprint $table) {
            $table->dropUnique('personals_cedula_unique'); // Revierte la restricción unique
            $table->integer('cedula')->change(); // Revierte el tipo a integer
        });
    }
};
