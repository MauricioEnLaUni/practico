<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    use HasFactory;

    protected $table = "venta_detalle";
    protected $primaryKey = "id";
    protected $keyType = "int";

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    protected static function booted()
    {
        static::created(function ($model) {
            $model->created_at = now();
        });

        static::saving(function ($model) {
            $model->updated_at = now();
        });
    }
}
