<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre_negocio',
        'subscription_type',
        'fecha_suscripcion',
        'fecha_ultimo_pago',
        'fecha_fin_suscripcion',
    ];

    // Campos que se deben tratar como fechas
    protected $dates = [
        'fecha_suscripcion',
        'fecha_ultimo_pago',
        'fecha_fin_suscripcion',
    ];
}
