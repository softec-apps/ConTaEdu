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
        Schema::create('ejercicios', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('desc');
            $table->foreignId('docente_id');
            $table->foreign('docente_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE'); // Foreign Key
            $table->string('access_code', 6)->unique()->charset('ascii')->collation('ascii_bin');
            $table->foreignId('template_id')->nullable()->constrained('templates');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejercicios');
    }
};
