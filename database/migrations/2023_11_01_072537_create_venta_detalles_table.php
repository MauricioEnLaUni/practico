<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('venta_detalle', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("id_venta");
            $table->string("id_producto", 45);
            $table->decimal("precio", $precision = 8, $scale = 2);
            $table->integer("cantidad");
            $table->decimal("utilidad", $precision = 8, $scale = 2);
            $table->timestamp("created_at");
            $table->datetime("updated_at")->nullable();

            $table->index("id_venta", "venta_idx");
            $table->index("id_producto", "producto_idx");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('venta_detalle');
    }
};
