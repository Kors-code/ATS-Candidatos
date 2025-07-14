<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $fillable = [
        'nombre',
        'email',
        'cv',
        'vacante_id',
        'cv_text',
        'estado',
        'razon_ia',
    ];
 public function vacante()
{
    return $this->belongsTo(Vacante::class);
}

}
