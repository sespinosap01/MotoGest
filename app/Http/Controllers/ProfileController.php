<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit($profile)
    {
        $user = Auth::user();

        return view('perfil.edit', compact('user'));
    }

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

    public function destroy($profile){
        $user = Auth::user();

        $user ->delete();

        return redirect()->route('register');
    }
}
