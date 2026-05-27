<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanEntrenamiento;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        $planes = PlanEntrenamiento::where('id_ciclista', Auth::id())
            ->orderBy('fecha_inicio', 'desc')
            ->get();

        return view('planes.index', compact('planes'));
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        return view('planes.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:500',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'objetivo' => 'nullable|string|max:200'
        ]);

        PlanEntrenamiento::create([
            'id_ciclista' => Auth::id(),
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'objetivo' => $request->objetivo,
            'activo' => true
        ]);

        return redirect()->route('planes.index')
            ->with('success', 'Plan creado correctamente');
    }

    public function show(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        $plan = PlanEntrenamiento::findOrFail($id);

        if ($plan->id_ciclista != Auth::id()) {
            abort(403, 'No autorizado para ver este plan');
        }

        return view('planes.show', compact('plan'));
    }

    public function edit(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        $plan = PlanEntrenamiento::findOrFail($id);

        if ($plan->id_ciclista != Auth::id()) {
            abort(403, 'No autorizado para editar este plan');
        }

        return view('planes.edit', compact('plan'));
    }

    public function update(Request $request, string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        $plan = PlanEntrenamiento::findOrFail($id);

        if ($plan->id_ciclista != Auth::id()) {
            abort(403, 'No autorizado para actualizar este plan');
        }

        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:500',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'objetivo' => 'nullable|string|max:200',
            'activo' => 'boolean'
        ]);

        $plan->update($request->only([
            'nombre', 'descripcion', 'fecha_inicio', 'fecha_fin', 'objetivo', 'activo'
        ]));

        return redirect()->route('planes.index')
            ->with('success', 'Plan actualizado correctamente');
    }

    public function destroy(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        $plan = PlanEntrenamiento::findOrFail($id);

        if ($plan->id_ciclista != Auth::id()) {
            abort(403, 'No autorizado para eliminar este plan');
        }

        $plan->delete();

        return redirect()->route('planes.index')
            ->with('success', 'Plan eliminado correctamente');
    }
}
