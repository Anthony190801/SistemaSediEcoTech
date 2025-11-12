<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Articulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'url_foto',
        'precio',
    ];

    public function premios(): HasMany
    {
        return $this->hasMany(Premio::class);
    }
}
