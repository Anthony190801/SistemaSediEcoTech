<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Precio extends Model
{
    use HasFactory;

    protected $table = 'precios';

    protected $fillable = [
        'cantidad_soles',
    ];

    public function materialPrecios(): HasMany
    {
        return $this->hasMany(MaterialPrecio::class);
    }
}
