<?php

namespace App\Http\Controllers;

use App\Models\Negocio;
use Illuminate\Http\Request;

class NegocioController extends Controller
{
    // Mostrar todos los negocios
    public function indexNegocios()
    {
        $negocios = Negocio::all();
        return response()->json($negocios);
    }

    // Almacenar un nuevo negocio
    public function storeNegocios(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'nombre_negocio' => 'required|string',
            'subscription_type' => 'required|string',
            'fecha_suscripcion' => 'required|date',
            'fecha_ultimo_pago' => 'required|date',
            'fecha_fin_suscripcion' => 'required|date',
        ]);

        // Crear el negocio
        $negocio = Negocio::create([
            'nombre_negocio' => $request->nombre_negocio,
            'subscription_type' => $request->subscription_type,
            'fecha_suscripcion' => $request->fecha_suscripcion,
            'fecha_ultimo_pago' => $request->fecha_ultimo_pago,
            'fecha_fin_suscripcion' => $request->fecha_fin_suscripcion,
        ]);

        return response()->json(['message' => 'Negocio creado con éxito', 'negocio' => $negocio], 201);
    }

    // Actualizar un negocio existente
    public function updateNegocios(Request $request, $id)
    {
        $negocio = Negocio::findOrFail($id);

        // Validación de los datos
        $request->validate([
            'nombre_negocio' => 'required|string',
            'subscription_type' => 'required|string',
            'fecha_suscripcion' => 'required|date',
            'fecha_ultimo_pago' => 'required|date',
            'fecha_fin_suscripcion' => 'required|date',
        ]);

        // Actualizar el negocio
        $negocio->update([
            'nombre_negocio' => $request->nombre_negocio,
            'subscription_type' => $request->subscription_type,
            'fecha_suscripcion' => $request->fecha_suscripcion,
            'fecha_ultimo_pago' => $request->fecha_ultimo_pago,
            'fecha_fin_suscripcion' => $request->fecha_fin_suscripcion,
        ]);

        return response()->json(['message' => 'Negocio actualizado con éxito', 'negocio' => $negocio]);
    }

}
