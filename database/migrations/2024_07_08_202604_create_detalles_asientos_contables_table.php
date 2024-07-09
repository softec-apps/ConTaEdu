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
        Schema::create('detalles_asientos_contables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asiento_id');
            $table->foreign('asiento_id')->references('id')->on('asientos_contables')->onDelete('CASCADE')->onUpdate('CASCADE'); // Foreign Key
            $table->foreignId('cuenta_id');
            $table->foreign('cuenta_id')->references('id')->on('plan_cuentas')->onDelete('CASCADE')->onUpdate('CASCADE'); // Foreign Key
            $table->enum('tipo_movimiento', ['debe', 'haber'])->default('haber');
            $table->double('monto')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_asientos_contables');
    }
};
