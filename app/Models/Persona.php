<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';

    protected $fillable = [
        'dni',
        'nombres',
        'apellidos',
        'sexo',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function participantes(): HasMany
    {
        return $this->hasMany(Participante::class);
    }
}
