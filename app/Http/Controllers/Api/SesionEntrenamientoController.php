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
        $userId = auth()->id();

        $sesiones = SesionEntrenamiento::whereHas('plan', function ($q) use ($userId) {
            $q->where('id_ciclista', $userId);
        })->get();

        return response()->json($sesiones);
    }

    public function show($id)
    {
        $sesion = SesionEntrenamiento::whereHas('plan', function ($q) {
            $q->where('id_ciclista', auth()->id());
        })->find($id);

        if (!$sesion) {
            return response()->json(['error' => 'No autorizado'], 404);
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
            'completada' => 'boolean'
        ]);

        $plan = \App\Models\PlanEntrenamiento::where('id_ciclista', auth()->id())->find($validated['id_plan']);
        if (!$plan) {
            return response()->json(['error' => 'Plan no autorizado'], 403);
        }

        $sesion = SesionEntrenamiento::create($validated);

        return response()->json($sesion, 201);
    }

   public function update(Request $request, $id)
{
    $sesion = SesionEntrenamiento::whereHas('plan', function ($q) {
        $q->where('id_ciclista', auth()->id());
    })->find($id);

    if (!$sesion) {
        return response()->json(['error' => 'No autorizado'], 404);
    }

    $validated = $request->validate([
        'id_plan' => 'required|exists:plan_entrenamiento,id',
        'fecha' => 'required|date',
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'completada' => 'boolean'
    ]);

    $sesion->update($validated);

    return response()->json($sesion);
}

    public function destroy($id)
    {
        $sesion = SesionEntrenamiento::whereHas('plan', function ($q) {
            $q->where('id_ciclista', auth()->id());
        })->find($id);

        if (!$sesion) {
            return response()->json(['error' => 'No autorizado'], 404);
        }

        $sesion->delete();

        return response()->json(null, 204);
    }
}