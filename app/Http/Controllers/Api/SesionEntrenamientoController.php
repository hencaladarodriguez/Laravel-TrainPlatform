<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SesionEntrenamiento;
use App\Models\PlanEntrenamiento;
use Illuminate\Http\Request;

class SesionEntrenamientoController extends Controller
{
public function index()
{
    $sesiones = SesionEntrenamiento::whereHas('plan', function ($query) {
        $query->where('id_ciclista', auth()->id());
    })->get();

    return response()->json($sesiones);
}

    public function show($id)
    {
        $sesion = SesionEntrenamiento::whereHas('plan', function ($query) {
            $query->where('id_ciclista', auth()->user()->id);
        })->find($id);

        if (!$sesion) {
            return response()->json(['error' => 'No encontrada'], 404);
        }

        return response()->json($sesion);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_plan' => 'required|exists:plan_entrenamiento,id',
            'fecha' => 'required|date',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'completada' => 'required'
        ]);

        $plan = PlanEntrenamiento::findOrFail($validated['id_plan']);
        if ($plan->id_ciclista !== auth()->user()->id) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $validated['completada'] = filter_var($request->completada, FILTER_VALIDATE_BOOLEAN);
        $sesion = SesionEntrenamiento::create($validated);

        return response()->json($sesion, 201);
    }

    public function update(Request $request, $id)
    {
$sesion = SesionEntrenamiento::whereHas('plan', function ($query) {
    $query->where('id_ciclista', auth()->id());
})->find($id);
        if (!$sesion) {
            return response()->json(['error' => 'No encontrada o no autorizado'], 404);
        }

        $validated = $request->validate([
            'id_plan' => 'required|exists:plan_entrenamiento,id',
            'fecha' => 'required|date',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'completada' => 'required'
        ]);

        $validated['completada'] = filter_var($request->completada, FILTER_VALIDATE_BOOLEAN);

        $sesion->update($validated);

        return response()->json($sesion);
    }

    public function destroy($id)
    {
        $sesion = SesionEntrenamiento::find($id);

        if (!$sesion) {
            return response()->json(['error' => 'No encontrada'], 404);
        }

        $sesion->delete();

        return response()->json(['message' => 'Eliminada']);
    }
}