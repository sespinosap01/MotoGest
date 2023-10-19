<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Moto;
use App\Models\User;
use Illuminate\Http\Request;

class MotoController extends Controller
{
    public function index()
    {
        $motos = Moto::all();
        $users = User::all();
        $totalMotos = Moto::count();
        return view('auth.admin.motos.index', ['motos' => $motos, 'users' => $users, 'totalMotos' => $totalMotos]);
    }

    public function create(){
        
        $users = User::all();
        
        return view('auth.admin.motos.create')->with('users', $users);
    }

    public function store(Request $request){
        return $this->saveMoto($request, null);
    }

    public function update(Request $request , $idMoto){
        $moto = Moto::find($idMoto);

        return $this->saveMoto($request, $idMoto);
    }

    public function saveMoto(Request $request, $idMoto){
        if($idMoto){
            $moto = Moto::find($idMoto);
        }else{
            $moto = new Moto();            
        }

        $moto->idUsuario = $request->input('idUsuario');
        $moto->marca = $request->input('marca');
        $moto->modelo = $request->input('modelo');
        $moto->potencia = $request->input('potencia');
        $moto->fechaFabricacion = $request->input('fechaFabricacion');
        $moto->kilometraje = $request->input('kilometraje');
        $moto->imagen = $request->input('imagen');        
        $moto->matricula = $request->input('matricula');        

        $moto->save();
        return redirect()->route('motos.index');
    }

    public function edit($idMoto){
        $moto = Moto::find($idMoto);

        $users = User::all();
        
        return view('auth.admin.motos.edit', ['moto' => $moto], ['users' => $users]);
    }

    public function destroy(string $idMoto){
        $moto = Moto::find($idMoto);

        $moto ->delete();

        return redirect()->route('motos.index');
    }
}
