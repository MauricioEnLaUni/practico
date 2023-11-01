<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string("nombre", 45);
            $table->string("apellido", 45);
            $table->string("direccion", 100);
            $table->string("email", 45)->unique();
            $table->string("usuario", 45)->unique();
            $table->date("fecha_nacimiento");
            $table->timestamp("created_at")->nullable();
            $table->datetime("updated_at")->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
