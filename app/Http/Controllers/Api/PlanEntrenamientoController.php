<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlanEntrenamiento;
use Illuminate\Http\Request;

class PlanEntrenamientoController extends Controller
{
    public function index()
    {
        $planes = PlanEntrenamiento::where('id_ciclista', auth()->user()->id)->get();
        return response()->json($planes);
    }
    
    public function show($id)
    {
        $plan = PlanEntrenamiento::where('id_ciclista', auth()->user()->id)->find($id);

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

        $validated['id_ciclista'] = auth()->user()->id;

        $plan = PlanEntrenamiento::create($validated);

        return response()->json($plan, 201);
    }

    public function update(Request $request, $id)
    {
        $plan = PlanEntrenamiento::where('id_ciclista', auth()->user()->id)->find($id);

        if (!$plan) {
            return response()->json(['error' => 'No encontrado'], 404);
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'objetivo' => 'nullable|string',
            'activo' => 'required'
        ]);

        $plan->update($validated);

        return response()->json($plan);
    }

    public function destroy($id)
    {
        $plan = PlanEntrenamiento::where('id_ciclista', auth()->user()->id)->find($id);

        if (!$plan) {
            return response()->json(['error' => 'No encontrado'], 404);
        }

        $plan->delete();

        return response()->json(['message' => 'Eliminado']);
    }
}