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
            PlanEntrenamiento::where('id_ciclista', auth()->id())->get()
        );
    }
    
    public function show($id)
    {
        $plan = PlanEntrenamiento::where('id_ciclista', auth()->id())
                    ->find($id);

        if (!$plan) {
            return response()->json(['error' => 'No autorizado'], 404);
        }

        return response()->json($plan);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'objetivo' => 'nullable|string',
            'activo' => 'boolean'
        ]);

        $validated['id_ciclista'] = auth()->id();

        $plan = PlanEntrenamiento::create($validated);

        return response()->json($plan, 201);
    }


    public function update(Request $request, $id)
    {
        $plan = PlanEntrenamiento::where('id_ciclista', auth()->id())->find($id);

        if (!$plan) {
            return response()->json(['error' => 'No autorizado'], 404);
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'objetivo' => 'nullable|string',
            'activo' => 'boolean'
        ]);

        $plan->update($validated);

        return response()->json($plan);
    }

    public function destroy($id)
    {
        $plan = PlanEntrenamiento::where('id_ciclista', auth()->id())->find($id);

        if (!$plan) {
            return response()->json(['error' => 'No autorizado'], 404);
        }

        $plan->delete();

        return response()->json(null, 204);
    }
}