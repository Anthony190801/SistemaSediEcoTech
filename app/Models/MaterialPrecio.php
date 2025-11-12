<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaterialPrecio extends Model
{
    use HasFactory;

    protected $table = 'material_precio';

    protected $fillable = [
        'material_id',
        'precio_id',
        'puntaje',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected function casts(): array
    {
        return [
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date',
        ];
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function precio(): BelongsTo
    {
        return $this->belongsTo(Precio::class);
    }

    public function proyectos(): BelongsToMany
    {
        return $this->belongsToMany(Proyecto::class, 'material_precio_proyecto', 'material_precio_id', 'proyecto_id');
    }

    public function recolecciones(): HasMany
    {
        return $this->hasMany(Recoleccion::class);
    }
}
