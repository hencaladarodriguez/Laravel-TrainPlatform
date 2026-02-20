<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SesionBloque;
use Illuminate\Http\Request;

class SesionBloqueController extends Controller
{
    public function index()
    {
        return response()->json(SesionBloque::all());
    }

    public function show($id)
    {
        $sesionBloque = SesionBloque::find($id);

        if (!$sesionBloque) {
            return response()->json(['error' => 'No encontrado'], 404);
        }

        return response()->json($sesionBloque);
    }

    public function store(Request $request)
    {
        $sesionBloque = SesionBloque::create($request->all());

        return response()->json($sesionBloque, 201);
    }

    public function update(Request $request, $id)
    {
        $sesionBloque = SesionBloque::find($id);

        if (!$sesionBloque) {
            return response()->json(['error' => 'No encontrado'], 404);
        }

        $sesionBloque->update($request->all());

        return response()->json($sesionBloque);
    }

    public function destroy($id)
    {
        $sesionBloque = SesionBloque::find($id);

        if (!$sesionBloque) {
            return response()->json(['error' => 'No encontrado'], 404);
        }

        $sesionBloque->delete();

        return response()->json(['message' => 'Eliminado']);
    }
}