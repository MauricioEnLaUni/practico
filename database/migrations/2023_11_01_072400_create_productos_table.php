<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->string("upc", 45)->unique();
            $table->string("descripcion", 100);
            $table->decimal("costo", $precision = 8, $scale = 2);
            $table->decimal("precio", $precision = 8, $scale = 2);
            $table->integer("existencia")->nullable();
            $table->timestamp("created_at");
            $table->datetime("updated_at");

            $table->primary("upc");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
