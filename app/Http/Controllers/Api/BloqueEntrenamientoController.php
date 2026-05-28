<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloqueEntrenamiento;
use Illuminate\Http\Request;

class BloqueEntrenamientoController extends Controller
{
    public function index()
    {
        return response()->json(
            BloqueEntrenamiento::where('id_ciclista', auth()->id())->get()
        );
    }

    public function show($id)
    {
        $bloque = BloqueEntrenamiento::where('id_ciclista', auth()->id())
                                    ->find($id);

        if (!$bloque) {
            return response()->json(['error' => 'No autorizado'], 404);
        }

        return response()->json($bloque);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'tipo' => 'required|string|max:100',
            'duracion_estimada' => 'nullable|string',
            'potencia_pct_min' => 'nullable|numeric',
            'potencia_pct_max' => 'nullable|numeric',
            'pulso_pct_max' => 'nullable|numeric',
            'pulso_reserva_pct' => 'nullable|numeric',
            'comentario' => 'nullable|string'
        ]);

        $validated['id_ciclista'] = auth()->id();

        $bloque = BloqueEntrenamiento::create($validated);

        return response()->json($bloque, 201);
    }

    public function update(Request $request, $id)
    {
        $bloque = BloqueEntrenamiento::where('id_ciclista', auth()->id())->find($id);

        if (!$bloque) {
            return response()->json(['error' => 'No autorizado'], 404);
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'tipo' => 'required|string|max:100',
            'duracion_estimada' => 'nullable|string',
            'potencia_pct_min' => 'nullable|numeric',
            'potencia_pct_max' => 'nullable|numeric',
            'pulso_pct_max' => 'nullable|numeric',
            'pulso_reserva_pct' => 'nullable|numeric',
            'comentario' => 'nullable|string'
        ]);

        $bloque->update($validated);

        return response()->json($bloque);
    }

    public function destroy($id)
    {
        $bloque = BloqueEntrenamiento::where('id_ciclista', auth()->id())->find($id);

        if (!$bloque) {
            return response()->json(['error' => 'No autorizado'], 404);
        }

        $bloque->delete();

        return response()->json(null, 204);
    }
}