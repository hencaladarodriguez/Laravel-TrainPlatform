<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrenamiento;

class ResultadoController extends Controller
{
    public function index()
    {
        $resultados = Entrenamiento::with([
            'ciclista',
            'sesion',
            'bicicleta'
        ])->get();

        return view('resultados.index', compact('resultados'));
    }

    public function create()
    {
        return view('resultados.create');
    }

    public function store(Request $request)
    {
        Entrenamiento::create($request->all());
        return redirect()->route('resultados.index');
    }

    public function show($id)
    {
        $resultado = Entrenamiento::findOrFail($id);
        return view('resultados.show', compact('resultado'));
    }
}
