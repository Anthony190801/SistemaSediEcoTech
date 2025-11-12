<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InstitucionProyecto extends Model
{
    use HasFactory;

    protected $table = 'institucion_proyecto';

    protected $fillable = [
        'institucion_id',
        'proyecto_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha_inicio' => 'datetime',
            'fecha_fin' => 'datetime',
        ];
    }

    public function institucion(): BelongsTo
    {
        return $this->belongsTo(Institucion::class);
    }

    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function participantes(): HasMany
    {
        return $this->hasMany(Participante::class);
    }

    public function premios(): HasMany
    {
        return $this->hasMany(Premio::class);
    }

    public function anuncios(): HasMany
    {
        return $this->hasMany(Anuncio::class);
    }
}
