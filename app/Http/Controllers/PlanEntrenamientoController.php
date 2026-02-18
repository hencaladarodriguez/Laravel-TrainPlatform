<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanEntrenamiento;
use App\Models\Ciclista;

class PlanEntrenamientoController extends Controller
{
    public function index()
    {
        $planes = PlanEntrenamiento::with('ciclista')->get();
        return view('planes.index', compact('planes'));
    }

    public function create()
    {
        $ciclistas = Ciclista::all();
        return view('planes.create', compact('ciclistas'));
    }

    public function store(Request $request)
    {
        PlanEntrenamiento::create($request->all());
        return redirect()->route('planes.index');
    }

    public function edit($id)
    {
        $plan = PlanEntrenamiento::findOrFail($id);
        $ciclistas = Ciclista::all();

        return view('planes.edit', compact('plan','ciclistas'));
    }

    public function update(Request $request, $id)
    {
        $plan = PlanEntrenamiento::findOrFail($id);
        $plan->update($request->all());

        return redirect()->route('planes.index');
    }

    public function destroy($id)
    {
        PlanEntrenamiento::destroy($id);
        return redirect()->route('planes.index');
    }
}
