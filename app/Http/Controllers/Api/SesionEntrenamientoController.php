<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SesionEntrenamiento;
use Illuminate\Http\Request;

class SesionEntrenamientoController extends Controller
{
    public function index()
    {
        return response()->json(
            SesionEntrenamiento::with('plan')->get()
        );
    }

    public function show($id)
    {
        $sesion = SesionEntrenamiento::with('plan')->find($id);

        if (!$sesion) {
            return response()->json(['error' => 'No encontrada'], 404);
        }

        return response()->json($sesion);
    }

    public function store(Request $request)
    {
        $sesion = SesionEntrenamiento::create($request->all());

        return response()->json($sesion, 201);
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