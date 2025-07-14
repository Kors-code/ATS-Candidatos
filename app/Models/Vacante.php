<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Vacante extends Model
{
    protected $fillable = ['titulo', 'descripcion', 'palabras_clave'];

    protected $casts = [
        'palabras_clave' => 'array',
    ];


protected static function booted()
{
    static::creating(function ($vacante) {
        $vacante->slug = Str::slug($vacante->titulo);
    });
}

    public function candidatos()
    {
        return $this->hasMany(Candidato::class);
    }
}
