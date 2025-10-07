<?php

namespace App\Models\Ciberi;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    // Forzar uso de la conexión secundaria
    protected $connection = 'mysql_ciberi';

    protected $table = 'configs'; // nombre exacto de la tabla

    protected $fillable = [
        'siigo_user',
        'siigo_key',
        'identification_number',
        'business_name',
        'address',
        'phone',
        'email',
        'trm_euro',
        'trm_usd',
        'city',
        'consecutivo_comp_costo',
        'consecutivo_comp_venta',
        'consecutivo_comp_caja',
        'consecutivo_orden_compra',
        'enviar_consecutivo'
    ];
}
