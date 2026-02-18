<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SesionBloque;

class SesionBloqueController extends Controller
{
    public function index()
    {
        $sesionBloques = DB::table('sesion_bloque')->get();
        return view('sesionBloques.index', compact('sesionBloques'));
    }

    public function create()
    {
        return view('sesionBloques.create');
    }

    public function store(Request $request)
    {
        SesionBloque::create($request->all());
        return redirect()->route('sesionBloques.index');
    }

    public function edit($id)
    {
        $sesionBloque = SesionBloque::findOrFail($id);
        return view('sesionBloques.edit', compact('sesionBloque'));
    }

    public function update(Request $request, $id)
    {
        $sesionBloque = SesionBloque::findOrFail($id);
        $sesionBloque->update($request->all());

        return redirect()->route('sesionBloques.index');
    }

    public function destroy($id)
    {
        SesionBloque::destroy($id);
        return redirect()->route('sesionBloques.index');
    }
}
