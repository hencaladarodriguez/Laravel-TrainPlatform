<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanEntrenamiento;
use Illuminate\Support\Facades\Session;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Verificar que el usuario está logueado
        if (!Session::has('ciclista_id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }
        
        // Obtener planes SOLO del ciclista logueado
        $planes = PlanEntrenamiento::where('id_ciclista', Session::get('ciclista_id'))
            ->orderBy('fecha_inicio', 'desc')
            ->get();
        
        return view('planes.index', compact('planes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Session::has('ciclista_id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }
        
        return view('planes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Session::has('ciclista_id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }
        
        // Validar datos
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:500',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'objetivo' => 'nullable|string|max:200'
        ]);
        
        // Crear plan
        PlanEntrenamiento::create([
            'id_ciclista' => Session::get('ciclista_id'),
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Session::has('ciclista_id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }
        
        $plan = PlanEntrenamiento::findOrFail($id);
        
        // Verificar que el plan pertenece al ciclista logueado
        if ($plan->id_ciclista != Session::get('ciclista_id')) {
            abort(403, 'No autorizado para ver este plan');
        }
        
        return view('planes.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Session::has('ciclista_id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }
        
        $plan = PlanEntrenamiento::findOrFail($id);
        
        if ($plan->id_ciclista != Session::get('ciclista_id')) {
            abort(403, 'No autorizado para editar este plan');
        }
        
        return view('planes.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Session::has('ciclista_id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }
        
        $plan = PlanEntrenamiento::findOrFail($id);
        
        if ($plan->id_ciclista != Session::get('ciclista_id')) {
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
        
        $plan->update($request->all());
        
        return redirect()->route('planes.index')
            ->with('success', 'Plan actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Session::has('ciclista_id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }
        
        $plan = PlanEntrenamiento::findOrFail($id);
        
        if ($plan->id_ciclista != Session::get('ciclista_id')) {
            abort(403, 'No autorizado para eliminar este plan');
        }
        
        $plan->delete();
        
        return redirect()->route('planes.index')
            ->with('success', 'Plan eliminado correctamente');
    }
}