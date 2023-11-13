<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //metodo que muestra el formulario para editar tu propio perfil
    public function edit($profile)
    {
        $user = Auth::user();

        return view('perfil.edit', compact('user'));
    }

    //metodo que actualiza los campos que hayan cambiado
    public function update(Request $request, $profile)
    {
        $user = Auth::user();

        $user->nombre = $request->input('nombre');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->fechaNacimiento = $request->input('fechaNacimiento');
        $user->numTelefono = $request->input('numTelefono');
        $user->rol_id = $request->input('rol_id');

        $user->save();
        return redirect()->route('home', ['profile' => $user->idUsuario]);
    }

    //metodo para eliminar tu propio perfil
    public function destroy($profile){
        $user = Auth::user();

        $user ->delete();

        return redirect()->route('register');
    }
}
