<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Premio extends Model
{
    use HasFactory;

    protected $table = 'premios';

    protected $fillable = [
        'articulo_id',
        'institucion_proyecto_id',
        'tipo',
        'puntaje_requerido',
        'estado',
    ];

    public function articulo(): BelongsTo
    {
        return $this->belongsTo(Articulo::class);
    }

    public function institucionProyecto(): BelongsTo
    {
        return $this->belongsTo(InstitucionProyecto::class);
    }

    public function canjes(): HasMany
    {
        return $this->hasMany(Canje::class);
    }
}
