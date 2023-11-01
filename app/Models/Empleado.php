<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = "empleado";
    protected $primaryKey = "id";
    protected $keyType = 'int';

    protected $guarded = ["created_at", "updated_at"];

    public function venta()
    {
        return $this->hasMany(Venta::class, "id_empleado");
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
