<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SesionEntrenamiento;
use App\Models\PlanEntrenamiento;

class SesionEntrenamientoController extends Controller
{
    public function index()
    {
        $sesiones = SesionEntrenamiento::with('plan')->get();
        return view('sesiones.index', compact('sesiones'));
    }

    public function create()
    {
        $planes = PlanEntrenamiento::all();
        return view('sesiones.create', compact('planes'));
    }

    public function store(Request $request)
    {
        $sesion = SesionEntrenamiento::create($request->all());
        return response()->json($sesion);
    }
    
    public function update(Request $request, $id)
    {
        $sesion = SesionEntrenamiento::findOrFail($id);
        $sesion->update($request->all());

        return response()->json($sesion);
    }

    public function destroy($id)
    {
        SesionEntrenamiento::destroy($id);
        return redirect()->route('sesiones.index');
    }
}
