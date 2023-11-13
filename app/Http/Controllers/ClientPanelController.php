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
    //metodo para mostrar el panel del cliente
    public function clientPanel(){
    //obtiene el usuario autenticado
    $user = Auth::user();

    //obiene las motos asociadas al usuario
    $motos = $user->motos;

    //retorna la vista con las motos del usuario
    return view('clientes.clientPanel', compact('motos'));
    }

    //metodo que carga el formulario para crear motos
    public function create(){
                
        return view('clientes.motoCliente.create');
    }

    //metodo que inserta motos usando el metodo saveMoto
    public function store(Request $request){
        return $this->saveMoto($request, null);
    }

    //metodo que hace updates usando el metodo savemoto
    public function update(Request $request , $idMoto){
        //obtiene la moto por el id
        $moto = Moto::find($idMoto);

        //en caso de que se intente acceder por url a una moto que no le pertenece al usuario arroja un error de permisos
        if (Gate::denies('update', $moto)) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        return $this->saveMoto($request, $idMoto);
    } 

    //metodo para guardar los datos de una moto, ya sea creando una nueva o actualizando una existente
    public function saveMoto(Request $request, $idMoto){
        //verifica si se proporciona un id de moto para determinar si se está actualizando o creando una nueva
        if ($idMoto) {
            //se otiene la moto por id
            $moto = Moto::find($idMoto);
            //se guarda la ruta de la imagen existente para su posible eliminación posterior
            $oldImagePath = $moto->imagen;
        } else {
            //si no se proporciona un id se crea una nueva instancia de la clase Moto
            $moto = new Moto();
            //como es una moto nueva, la ruta de la imagen anterior se establece en null
            $oldImagePath = null;
        }
        //se asignan los valores de los campos de la moto con los datos proporcionados en la solicitud
        $moto->idUsuario = Auth::user()->idUsuario;
        $moto->marca = $request->input('marca');
        $moto->modelo = $request->input('modelo');
        $moto->cilindrada = $request->input('cilindrada');
        $moto->potencia = $request->input('potencia');
        $moto->fechaFabricacion = $request->input('fechaFabricacion');
        
        //verifica si se ha cargado un nuevo archivo de imagen en la solicitud
        if ($request->hasFile('imagen')) {
            //obtiene el archivo de imagen de la solicitud
            $image = $request->file('imagen');
            //genera un nombre único para la imagen basado en el tiempo actual y su extensión original
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            //mueve el archivo de imagen a la carpeta 'public/images/motoUsers' con el nuevo nombre
            $image->move(public_path('images/motoUsers'), $imageName);
            //se asigna la nueva ruta de la imagen a la moto
            $moto->imagen = 'images/motoUsers/' . $imageName;
    
            //en caso de haber una imagen anterior, se elimina del sistema de archivos
            if ($oldImagePath) {
                File::delete(public_path($oldImagePath));
            }
        }
    
        $moto->matricula = $request->input('matricula');

        //guarda los cambios en la base de datos
        $moto->save();
        return redirect()->route('clientes.clientPanel');
    }
    
    //metodo para cargar la vista del formulario de editar las motos
     public function edit($idMoto){
        //obtiene el id de la moto seleccionada a editar
        $moto = Moto::find($idMoto);
        //en caso de que se intente acceder por url a una moto que no le pertenece al usuario arroja un error de permisos
        if (Gate::denies('update', $moto)) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }
        return view('clientes.motoCliente.edit', ['moto' => $moto],);
    } 

    public function destroy(string $idMoto){
        //obtiene el id de la moto seleccionada a borrar
        $moto = Moto::find($idMoto);
    
        //almacena la ruta de la imagen asociada a la moto
        $imagePath = $moto->imagen;
    
        //elimina la moto de la base de datos
        $moto->delete();
    
        //en caso de que hubiese una foto asociada a la moto se elimina del sistema de archivos
        if ($imagePath) {
            File::delete(public_path($imagePath));
        }
    
        return redirect()->route('clientes.clientPanel');
    }
    
}
