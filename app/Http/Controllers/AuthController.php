<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciclista;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function form()
    {
        return view('login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Login para práctica sin hash
        $ciclista = Ciclista::where('email', $request->email)
            ->where('password', $request->password)
            ->first();

        if ($ciclista) {
            Session::put('ciclista_id', $ciclista->id);
            Session::put('ciclista_nombre', $ciclista->nombre);

            return redirect()->action([self::class, 'dashboard']);
        }

        return back()->with('error', 'Credenciales incorrectas');
    }

    // Dashboard protegido
    public function dashboard()
    {
        if (!Session::has('ciclista_id')) {
            return redirect()->action([self::class, 'form']);
        }

        $menuPath = resource_path('json/menus.json');
        $menus = file_exists($menuPath) ? json_decode(file_get_contents($menuPath), true) : [];

        return view('dashboard', [
            'nombre' => Session::get('ciclista_nombre'),
            'menus' => $menus
        ]);
    }

    // Logout
    public function logout()
    {
        Session::flush();
        return redirect()->action([self::class, 'form']);
    }
}
