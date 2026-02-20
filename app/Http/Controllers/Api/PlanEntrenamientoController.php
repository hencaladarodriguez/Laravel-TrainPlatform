<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlanEntrenamiento;
use Illuminate\Http\Request;

class PlanEntrenamientoController extends Controller
{
    public function index()
    {
        return response()->json(
            PlanEntrenamiento::with('ciclista')->get()
        );
    }

    public function show($id)
    {
        $plan = PlanEntrenamiento::with('ciclista')->find($id);

        if (!$plan) {
            return response()->json(['error' => 'No encontrado'], 404);
        }

        return response()->json($plan);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_ciclista' => 'required|exists:ciclista,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'objetivo' => 'nullable|string',
            'activo' => 'required'
        ]);

        $validated['activo'] = filter_var($request->activo, FILTER_VALIDATE_BOOLEAN);

        $plan = PlanEntrenamiento::create($validated);

        return response()->json($plan, 201);
    }

    public function update(Request $request, $id)
    {
        $plan = PlanEntrenamiento::find($id);

        if (!$plan) {
            return response()->json(['error' => 'No encontrado'], 404);
        }

        $validated = $request->validate([
            'id_ciclista' => 'required|exists:ciclista,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'objetivo' => 'nullable|string',
            'activo' => 'required'
        ]);

        $validated['activo'] = filter_var($request->activo, FILTER_VALIDATE_BOOLEAN);

        $plan->update($validated);

        return response()->json($plan);
    }

    public function destroy($id)
    {
        $plan = PlanEntrenamiento::find($id);

        if (!$plan) {
            return response()->json(['error' => 'No encontrado'], 404);
        }

        $plan->delete();

        return response()->json(['message' => 'Eliminado']);
    }
}