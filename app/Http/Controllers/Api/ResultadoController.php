<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Entrenamiento;
use Illuminate\Http\Request;

class ResultadoController extends Controller
{
    public function index()
    {
        return response()->json(
            Entrenamiento::with(['ciclista','sesion','bicicleta'])->get()
        );
    }

    public function show($id)
    {
        $resultado = Entrenamiento::with(['ciclista','sesion','bicicleta'])->find($id);

        if (!$resultado) {
            return response()->json(['error' => 'No encontrado'], 404);
        }

        return response()->json($resultado);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_ciclista' => 'required|exists:ciclista,id',
            'id_sesion' => 'required|exists:sesion_entrenamiento,id',
            'id_bicicleta' => 'required|exists:bicicleta,id',
            'fecha' => 'required|date',
            'duracion' => 'nullable|string',
            'kilometros' => 'nullable|numeric',
            'recorrido' => 'nullable|string',
            'pulso_medio' => 'nullable|integer',
            'pulso_max' => 'nullable|integer',
            'potencia_media' => 'nullable|integer',
            'potencia_normalizada' => 'nullable|integer',
            'velocidad_media' => 'nullable|numeric',
            'puntos_estres_tss' => 'nullable|numeric',
            'factor_intensidad_if' => 'nullable|numeric',
            'ascenso_metros' => 'nullable|integer',
            'comentario' => 'nullable|string',
        ]);

        $resultado = Entrenamiento::create($validated);

        return response()->json($resultado, 201);
    }

    public function update(Request $request, $id)
    {
        $resultado = Entrenamiento::find($id);

        if (!$resultado) {
            return response()->json(['error' => 'No encontrado'], 404);
        }

        $validated = $request->validate([
            'id_ciclista' => 'required|exists:ciclista,id',
            'id_sesion' => 'required|exists:sesion_entrenamiento,id',
            'id_bicicleta' => 'required|exists:bicicleta,id',
            'fecha' => 'required|date',
            'duracion' => 'nullable|string',
            'kilometros' => 'nullable|numeric',
            'recorrido' => 'nullable|string',
            'pulso_medio' => 'nullable|integer',
            'pulso_max' => 'nullable|integer',
            'potencia_media' => 'nullable|integer',
            'potencia_normalizada' => 'nullable|integer',
            'velocidad_media' => 'nullable|numeric',
            'puntos_estres_tss' => 'nullable|numeric',
            'factor_intensidad_if' => 'nullable|numeric',
            'ascenso_metros' => 'nullable|integer',
            'comentario' => 'nullable|string',
        ]);

        $resultado->update($validated);

        return response()->json($resultado);
    }
}