<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Participante extends Model
{
    use HasFactory;

    protected $fillable = [
        'institucion_proyecto_id',
        'persona_id',
        'uuid',
        'anio',
        'nivel_academico',
        'ciclo_o_grado',
        'aula',
        'puntaje_total',
    ];

    public function institucionProyecto(): BelongsTo
    {
        return $this->belongsTo(InstitucionProyecto::class);
    }

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }

    public function recolecciones(): HasMany
    {
        return $this->hasMany(Recoleccion::class);
    }

    public function canjes(): HasMany
    {
        return $this->hasMany(Canje::class);
    }
}
