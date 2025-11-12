<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Respuesta extends Model
{
    use HasFactory;

    protected $table = 'respuestas';

    protected $fillable = [
        'lugar',
        'fecha_programada',
        'hora',
    ];

    protected function casts(): array
    {
        return [
            'fecha_programada' => 'date',
        ];
    }

    public function canjes(): HasMany
    {
        return $this->hasMany(Canje::class);
    }
}
