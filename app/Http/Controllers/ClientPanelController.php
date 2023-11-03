<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Moto;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


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

    public function update(Request $request , $idMoto){
        $moto = Moto::find($idMoto);

        if (Gate::denies('update', $moto)) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        return $this->saveMoto($request, $idMoto);
    } 

    public function saveMoto(Request $request, $idMoto){
        if ($idMoto) {
            $moto = Moto::find($idMoto);
            $oldImagePath = $moto->imagen;
        } else {
            $moto = new Moto();
            $oldImagePath = null;
        }
    
        $moto->idUsuario = Auth::user()->idUsuario;
        $moto->marca = $request->input('marca');
        $moto->modelo = $request->input('modelo');
        $moto->cilindrada = $request->input('cilindrada');
        $moto->potencia = $request->input('potencia');
        $moto->fechaFabricacion = $request->input('fechaFabricacion');
        
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/motoUsers'), $imageName);
            $moto->imagen = 'images/motoUsers/' . $imageName;
    
            if ($oldImagePath) {
                File::delete(public_path($oldImagePath));
            }
        }
    
        $moto->matricula = $request->input('matricula');
    
        $moto->save();
        return redirect()->route('clientes.clientPanel');
    }
    

     public function edit($idMoto){
        $moto = Moto::find($idMoto);
        if (Gate::denies('update', $moto)) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }
        return view('clientes.motoCliente.edit', ['moto' => $moto],);
    } 

    public function destroy(string $idMoto){
        $moto = Moto::find($idMoto);
    
        $imagePath = $moto->imagen;
    
        $moto->delete();
    
        if ($imagePath) {
            File::delete(public_path($imagePath));
        }
    
        return redirect()->route('clientes.clientPanel');
    }
    
}
