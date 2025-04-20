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
        Schema::table('asistencias', function (Blueprint $table) {
            $table->dropForeign(['personal_id']); // Elimina la clave foránea existente
            $table->dropColumn('personal_id'); // Elimina la columna personal_id
            $table->string('cedula'); // Agrega la columna cedula
            $table->foreign('cedula')->references('cedula')->on('personals')->onDelete('cascade'); // Agrega la nueva clave foránea
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asistencias', function (Blueprint $table) {
            $table->dropForeign(['cedula']); // Revierte la clave foránea
            $table->dropColumn('cedula'); // Revierte la columna cedula
            $table->foreignId('personal_id')->constrained('personals')->onDelete('cascade'); // Agrega la columna y clave foránea anterior
        });
    }
};
