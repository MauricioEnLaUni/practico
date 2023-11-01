<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = "cliente";
    protected $primaryKey = "id";
    protected $keyType = 'int';

    protected $guarded = [];

    public function venta()
    {
        return $this->hasMany(Venta::class, "id_cliente");
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
