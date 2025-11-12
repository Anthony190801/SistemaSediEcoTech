<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recoleccion extends Model
{
    use HasFactory;

    protected $table = 'recolecciones';

    protected $fillable = [
        'participante_id',
        'material_precio_id',
        'cantidad_kilogramos',
        'fecha',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
        ];
    }

    public function participante(): BelongsTo
    {
        return $this->belongsTo(Participante::class);
    }

    public function materialPrecio(): BelongsTo
    {
        return $this->belongsTo(MaterialPrecio::class);
    }
}
