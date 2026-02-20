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
        $plan = PlanEntrenamiento::create($request->all());

        return response()->json($plan, 201);
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