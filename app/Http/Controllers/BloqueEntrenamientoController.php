<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloqueEntrenamiento;

class BloqueEntrenamientoController extends Controller
{
    public function index()
    {
        $bloques = BloqueEntrenamiento::all();
        return view('bloques.index', compact('bloques'));
    }

    public function show($id)
    {
        $bloque = BloqueEntrenamiento::findOrFail($id);
        return view('bloques.show', compact('bloque'));
    }

    public function create()
    {
        return view('bloques.create');
    }

    public function store(Request $request)
    {
        BloqueEntrenamiento::create($request->all());
        return redirect()->route('bloques.index');
    }

    public function destroy($id)
    {
        BloqueEntrenamiento::destroy($id);
        return redirect()->route('bloques.index');
    }
}
