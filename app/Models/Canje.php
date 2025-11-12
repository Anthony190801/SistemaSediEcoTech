<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Canje extends Model
{
    use HasFactory;

    protected $table = 'canjes';

    protected $fillable = [
        'premio_id',
        'participante_id',
        'fecha_solicitud_canje',
        'estado',
        'respuesta_id',
        'fecha_entrega',
    ];

    protected function casts(): array
    {
        return [
            'fecha_solicitud_canje' => 'date',
            'fecha_entrega' => 'datetime',
        ];
    }

    public function premio(): BelongsTo
    {
        return $this->belongsTo(Premio::class);
    }

    public function participante(): BelongsTo
    {
        return $this->belongsTo(Participante::class);
    }

    public function respuesta(): BelongsTo
    {
        return $this->belongsTo(Respuesta::class);
    }
}
