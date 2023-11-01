<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("id_empleado");
            $table->unsignedInteger("id_cliente");
            $table->decimal("total");
            $table->tinyInteger("estatus");
            $table->timestamp("created_at");
            $table->datetime("updated_at");

            $table->index("id_empleado", "empleado_idx");
            $table->index("id_cliente", "cliente_idx");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('venta');
    }
};
