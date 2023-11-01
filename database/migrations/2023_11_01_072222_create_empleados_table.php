<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->increments("id");
            $table->string("nombre", 45);
            $table->string("apellido", 45);
            $table->string("telefono", 20);
            $table->timestamp("created_at");
            $table->datetime("updated_at");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empleado');
    }
};
