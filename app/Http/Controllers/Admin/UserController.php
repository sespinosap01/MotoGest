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
    //metodo que carga la tabla de usuarios paginada
    public function index()
    {
        //se obtienen todas los usuarios paginados de 10 en 10 registros
        $users = User::paginate(10); 
        //se obtiene el conteo total de usuarios 
        $totalUsers = User::count(); 
    
        return view('auth.admin.users.index', ['users' => $users, 'totalUsers' => $totalUsers]);
    }
    
    //metodo para cargar la vista del formulario de crear usuarios
    public function create(){
        //se obienen los roles de la base de datos para cargarlos en el select
        $roles = Rol::all();
        
        return view('auth.admin.users.create')->with('roles', $roles);
    }

    //metodo para hacer inserciones de usuarios en la bbdd
    public function store(Request $request){

        return $this->saveUser($request, null);
    }

    //metodo para hacer updates de usuarios en la bbdd
    public function update(Request $request, $idUsuario){
        //se obtiene al usuario por id
        $user = User::find($idUsuario);
        //llama al metodo saveUser para guardar los datos actualizados del usuario
        $this->saveUser($request, $idUsuario);
    
        //recupera la url anterior de la sesion
        $previousUrl = $request->session()->get('previous_url');
    
        return redirect($previousUrl);
    }
    

    //metodo para guardar los datos de un usuario, ya sea creando uno nuevo o actualizando uno existente
    public function saveUser(Request $request, $idUsuario){
        //verifica si se proporciona un id de usuario para determinar si se está actualizando o creando uno nuevo
        if($idUsuario){
            //se otiene el usuario por id
            $user = User::find($idUsuario);
        }else{
            //si no se proporciona un id se crea una nueva instancia de la clase User
            $user = new User();            
        }
        
        //se asignan los valores de los campos de la moto con los datos proporcionados en la solicitud
        $user->nombre = $request->input('nombre');
        $user->email = $request->input('email');
        //en caso de que no se introduzca contraseña no se modificara
        if ($request->filled('password')) {
            $user->password = $request->input('password');
        }
        $user->fechaNacimiento = $request->input('fechaNacimiento');
        $user->numTelefono = $request->input('numTelefono');
        $user->rol_id = $request->input('rol_id');

        //verifica si ya existe un usuario con el mismo email (excepto el usuario actual en caso de actualización)
        $existsteEmail = User::where('email', $user->email)->first();
        if ($existsteEmail && $existsteEmail->idUsuario !== $user->idUsuario) {
            //si existe, muestra la vista de creación de nuevo y evita guardar el usuario
            $roles = Rol::all();
            return view('auth.admin.users.create')->with('roles', $roles);       
        }

        //guarda el usuario en la base de datos
        $user->save();
        return redirect()->route('users.index');
    }

    //metodo para cargar la vista del formulario de editar los usuarios
    public function edit($idUsuario, Request $request){
        //obtiene el id del usuario seleccionado a editar
        $user = User::find($idUsuario);
    
        //en caso de acceder por url a una moto que no existe nos redirige al index
        if(!$user){
            return $this->index();
        }
    
        $roles = Rol::all();
    
        // Almacena la URL anterior en la sesión.
        $request->session()->put('previous_url', url()->previous());
    
        return view('auth.admin.users.edit', ['user' => $user, 'roles' => $roles]);
    }
    
    //metodo para borrar usuarios
    public function destroy($idUsuario){
        //obtiene el id del usuario
        $user = User::find($idUsuario);

        //borra el usuario seleccionado
        $user ->delete();

        return redirect()->back();
    }

    //metodo para borrar varios usuarios
    public function deleteMultiple(Request $request) {
        //obtiene los ids de los usuarios seleccionados
        $selectedUserIds = $request->input('selectedUsers');
    
        //verifica si no se han seleccionado usuarios, y en ese caso, redirige de vuelta
        if (empty($selectedUserIds)) {
            return redirect()->back();
        }

        //elimina los usuarios seleccionados de la base de datos
        User::whereIn('idUsuario', $selectedUserIds)->delete();
    
        return redirect()->back();
    }
    
    //metotodo para verificar si un email de usuario ya existe en la base de datos (se utiliza con ajax en front)
    public function checkEmail(Request $request)
    {
        // Obtiene el email de la solicitud
        $email = $request->input('email');

        //verifica si existe algún usuario con el email proporcionado
        $userExists = User::where('email', $email)->exists();

        //retorna una respuesta JSON indicando si el email existe o no
        return response()->json(['exists' => $userExists]);
    }
    

}
