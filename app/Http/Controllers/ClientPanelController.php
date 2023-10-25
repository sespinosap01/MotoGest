<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Moto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientPanelController extends Controller
{
    public function clientPanel(){
    $user = Auth::user();
    $motos = $user->motos;

    return view('clientes.clientPanel', compact('motos'));
    }

    public function create(){
        
        
        return view('clientes.motoCliente.create');
    }

    public function store(Request $request){
        return $this->saveMoto($request, null);
    }

/*     public function update(Request $request , $idMoto){
        $moto = Moto::find($idMoto);

        return $this->saveMoto($request, $idMoto);
    } */

    public function saveMoto(Request $request, $idMoto){
        if($idMoto){
            $moto = Moto::find($idMoto);
        }else{
            $moto = new Moto();            
        }

        $moto->idUsuario =  Auth::user()->idUsuario ;
        $moto->marca = $request->input('marca');
        $moto->modelo = $request->input('modelo');
        $moto->cilindrada = $request->input('cilindrada');
        $moto->potencia = $request->input('potencia');
        $moto->fechaFabricacion = $request->input('fechaFabricacion');
        $moto->imagen = $request->input('imagen');        
        $moto->matricula = $request->input('matricula');        

        $moto->save();
        return redirect()->route('clientes.clientPanel');
    }

   /*  public function edit($idMoto){
        $moto = Moto::find($idMoto);

        $users = User::all();
        
        return view('auth.admin.motos.edit', ['moto' => $moto], ['users' => $users]);
    } */

    public function destroy(string $idMoto){
        $moto = Moto::find($idMoto);

        $moto ->delete();

        return redirect()->route('clientes.clientPanel');
    }
}
