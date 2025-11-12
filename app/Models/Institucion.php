<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Institucion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion',
        'nivel',
    ];

    public function institucionProyectos(): HasMany
    {
        return $this->hasMany(InstitucionProyecto::class);
    }
}
