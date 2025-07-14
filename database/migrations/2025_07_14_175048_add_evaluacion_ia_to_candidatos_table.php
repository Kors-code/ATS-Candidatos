<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('candidatos', function (Blueprint $table) {
        $table->string('decision_ia')->nullable(); // Aprobado o Rechazado
        $table->text('razon_ia')->nullable();      // Breve explicación
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidatos', function (Blueprint $table) {
            //
        });
    }
};
