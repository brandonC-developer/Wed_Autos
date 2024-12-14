<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->string('placa', 10)->primary(); // PK
            $table->string('num_motor', 50);
            $table->year('anio');
            $table->string('marca', 50);
            $table->string('modelo', 50);
            $table->decimal('precio', 12, 2);
            $table->integer('kilometraje');
            $table->integer('cilindraje');
            $table->enum('transmision', ['Manual', 'Automatico']);
            $table->enum('combustible', ['Gasolina', 'Diesel', 'Electrico', 'Hibrido']);
            $table->string('color_exterior', 20);
            $table->string('color_interior', 20);
            $table->string('imagen_url', 500);
            $table->dateTime('fecha_registro')->default(DB::raw('CURRENT_TIMESTAMP')); // Usar timestamp para compatibilidad
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculo');
    }
};
