<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = "producto";
    protected $primaryKey = "upc";
    protected $keyType = "string";

    public $incrementing = false;

    protected $guarded = ["upc"];

    public function ventaDetalle()
    {
        return $this->hasMany(VentaDetalle::class, "id_producto");
    }

    protected static function booted()
    {
        static::created(function ($model) {
            $model->upc = Uuid::uuid4()->toString();
            $model->created_at = now();
        });

        static::saving(function ($model) {
            $model->updated_at = now();
        });
    }
}
