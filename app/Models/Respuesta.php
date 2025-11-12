<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Respuesta extends Model
{
    use HasFactory;

    protected $fillable = [
        'lugar',
        'fecha_programada',
        'hora',
    ];

    public function canjes(): HasMany
    {
        return $this->hasMany(Canje::class);
    }
}
