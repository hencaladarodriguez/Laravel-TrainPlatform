<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SesionBloque;
use Illuminate\Http\Request;

class SesionBloqueController extends Controller
{
    public function index()
    {
        return response()->json(
            SesionBloque::whereHas('sesion.plan', function ($query) {
                $query->where('id_ciclista', auth()->id());
            })->get()
        );
    }

    public function show($id)
    {
        $sesionBloque = SesionBloque::where('id_ciclista', auth()->id())
            ->find($id);

        if (!$sesionBloque) {
            return response()->json(['error' => 'No autorizado'], 404);
        }

        return response()->json($sesionBloque);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_sesion_entrenamiento' => 'required|exists:sesion_entrenamiento,id',
            'id_bloque_entrenamiento' => 'required|exists:bloque_entrenamiento,id',
            'orden' => 'required|integer',
            'repeticiones' => 'nullable|integer',
        ]);

        $sesionBloque = SesionBloque::create($validated);

        return response()->json($sesionBloque, 201);
    }

    public function update(Request $request, $id)
    {
        $sesionBloque = SesionBloque::find($id);

        if (!$sesionBloque) {
            return response()->json(['error' => 'No encontrado'], 404);
        }

        $validated = $request->validate([
            'id_sesion_entrenamiento' => 'required|exists:sesion_entrenamiento,id',
            'id_bloque_entrenamiento' => 'required|exists:bloque_entrenamiento,id',
            'orden' => 'required|integer',
            'repeticiones' => 'nullable|integer',
        ]);

        $sesionBloque->update($validated);

        return response()->json($sesionBloque);
    }

    public function destroy($id)
    {
        $sesionBloque = SesionBloque::find($id);

        if (!$sesionBloque) {
            return response()->json(['error' => 'No encontrado'], 404);
        }

        $sesionBloque->delete();

        return response()->json(['message' => 'Eliminado']);
    }
}