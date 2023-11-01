<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = "venta";
    protected $primaryKey = "id";
    protected $keyType = "int";

    protected $guarded = [];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function venta_detalle()
    {
        return $this->hasMany(VentaDetalle::class, "id_venta");
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
