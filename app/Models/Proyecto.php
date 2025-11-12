<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    protected $fillable = [
        'nombre',
        'url_logo',
        'estado',
    ];

    public function institucionProyectos(): HasMany
    {
        return $this->hasMany(InstitucionProyecto::class);
    }

    public function materialPrecios(): BelongsToMany
    {
        return $this->belongsToMany(MaterialPrecio::class, 'material_precio_proyecto', 'proyecto_id', 'material_precio_id');
    }
}
