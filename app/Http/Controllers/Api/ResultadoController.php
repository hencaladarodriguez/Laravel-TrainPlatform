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
            Entrenamiento::with([
                'ciclista',
                'sesion',
                'bicicleta'
            ])->get()
        );
    }

    public function show($id)
    {
        $resultado = Entrenamiento::with([
            'ciclista',
            'sesion',
            'bicicleta'
        ])->find($id);

        if (!$resultado) {
            return response()->json(['error' => 'No encontrado'], 404);
        }

        return response()->json($resultado);
    }

    public function store(Request $request)
    {
        $resultado = Entrenamiento::create($request->all());

        return response()->json($resultado, 201);
    }
}