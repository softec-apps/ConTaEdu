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
        Schema::create('plan_cuentas', function (Blueprint $table) {
            $table->id();
            $table->integer('cuenta');
            $table->string('description');
            $table->enum('signo', ['Positivo' => 'P', 'Negativo' => 'N', 'Doble' => 'D'])->default('P');
            $table->enum('tipocuenta', ['Total' => 'T', 'Detalle' => 'D'])->default('T');
            $table->enum('tipoestado', ['Estado de Situacion Financiera' => 1, 'Estado de resultados integral' => 2, 'Estados de flujo de efectivo' => 3, 'Null' => 4, 'Estado de cambios en el patrimonio' => 5])->default(4);
            $table->foreignId('template_id');
            $table->foreign('template_id')->references('id')->on('templates')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->boolean('est')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_cuentas');
    }
};
