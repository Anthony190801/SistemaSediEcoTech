<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Anuncio extends Model
{
    use HasFactory;

    protected $table = 'anuncios';

    protected $fillable = [
        'institucion_proyecto_id',
        'motivo',
        'fecha',
        'hora',
        'lugar',
        'estado',
        'fecha_inicial',
        'fecha_final',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
            'fecha_inicial' => 'datetime',
            'fecha_final' => 'datetime',
        ];
    }

    public function institucionProyecto(): BelongsTo
    {
        return $this->belongsTo(InstitucionProyecto::class);
    }
}
