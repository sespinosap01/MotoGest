<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $totalUsers = User::count();


        return view('auth.admin.users.index',  ['users'=>$users, 'totalUsers'=>$totalUsers]);
    }

    public function create(){
        
        $roles = Rol::all();
        
        return view('auth.admin.users.create')->with('roles', $roles);
    }

    public function store(Request $request){

        return $this->saveUser($request, null);
    }

    public function update(Request $request , $idUsuario){
        $user = User::find($idUsuario);

        return $this->saveUser($request, $idUsuario);
    }


    public function saveUser(Request $request, $idUsuario){
        if($idUsuario){
            $user = User::find($idUsuario);
        }else{
            $user = new User();            
        }

        $user->nombre = $request->input('nombre');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->fechaNacimiento = $request->input('fechaNacimiento');
        $user->numTelefono = $request->input('numTelefono');
        $user->rol_id = $request->input('rol_id');

        $user->save();
        return redirect()->route('users.index');
    }

    public function edit($idUsuario){
        $user = User::find($idUsuario);

        $roles = Rol::all();
        
        return view('auth.admin.users.edit', ['user' => $user], ['roles' => $roles]);
    }

    public function destroy($idUsuario){
        $user = User::find($idUsuario);

        $user ->delete();

        return redirect()->route('users.index');
    }

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $userExists = User::where('email', $email)->exists();

        return response()->json(['exists' => $userExists]);
    }
    

}
