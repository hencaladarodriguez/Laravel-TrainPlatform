<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Ciclista;

class AuthController extends Controller
{
    /* ========= FORM LOGIN ========= */
    public function showLogin()
    {
        return view('auth.login');
    }

    /* ========= FORM REGISTER ========= */
    public function showRegister()
    {
        return view('auth.register');
    }

    /* ========= REGISTER ========= */
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required|date',
            'peso_base' => 'required|numeric',
            'altura_base' => 'required|numeric',
            'email' => 'required|email|unique:ciclista,email',
            'password' => 'required|min:4'
        ]);

        Ciclista::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'peso_base' => $request->peso_base,
            'altura_base' => $request->altura_base,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login')
            ->with('success', 'Usuario creado');
    }

    /* ========= LOGIN ========= */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas'
        ]);
    }

    /* ========= LOGOUT ========= */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
