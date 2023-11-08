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
        $users = User::paginate(10); 
        $totalUsers = User::count(); 
    
        return view('auth.admin.users.index', ['users' => $users, 'totalUsers' => $totalUsers]);
    }
    

    public function create(){
        
        $roles = Rol::all();
        
        return view('auth.admin.users.create')->with('roles', $roles);
    }

    public function store(Request $request){

        return $this->saveUser($request, null);
    }

    public function update(Request $request, $idUsuario){
        $user = User::find($idUsuario);
    
        $this->saveUser($request, $idUsuario);
    
        $previousUrl = $request->session()->get('previous_url');
    
        return redirect($previousUrl);
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

        $existsteEmail = User::where('email', $user->email)->first();
        if ($existsteEmail && $existsteEmail->idUsuario !== $user->idUsuario) {
            $roles = Rol::all();
            return view('auth.admin.users.create')->with('roles', $roles);       
        }

        $user->save();
        return redirect()->route('users.index');
    }

    public function edit($idUsuario, Request $request){
        $user = User::find($idUsuario);
    
        if(!$user){
            return $this->index();
        }
    
        $roles = Rol::all();
    
        // Almacena la URL anterior en la sesión.
        $request->session()->put('previous_url', url()->previous());
    
        return view('auth.admin.users.edit', ['user' => $user, 'roles' => $roles]);
    }
    

    public function destroy($idUsuario){
        $user = User::find($idUsuario);

        $user ->delete();

        return redirect()->back();
    }

    public function deleteMultiple(Request $request) {
        $selectedUserIds = $request->input('selectedUsers');
    
        if (empty($selectedUserIds)) {
            return redirect()->back();
        }
    
        User::whereIn('idUsuario', $selectedUserIds)->delete();
    
        return redirect()->back();
    }
    

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $userExists = User::where('email', $email)->exists();

        return response()->json(['exists' => $userExists]);
    }
    

}
