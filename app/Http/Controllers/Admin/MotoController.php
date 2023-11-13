<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Moto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class MotoController extends Controller
{
    //metodo que carga la tabla de motos paginada
    public function index()
    {
        //se obtienen todas las motos paginadas y todos los usuarios para poder imprimir sus nombres en la tabla
        $motos = Moto::paginate(10); 
        $users = User::all();

        //se obtiene el total de registros de motos de la base de datos
        $totalMotos = Moto::count();
        return view('auth.admin.motos.index', ['motos' => $motos, 'users' => $users, 'totalMotos' => $totalMotos]);
    }

    //metodo para cargar la vista del formulario de crear las motos
    public function create(){        
        //se obtienen todos los usuarios para cargarlos en el select
        $users = User::all();
        
        return view('auth.admin.motos.create')->with('users', $users);
    }

    //metodo para hacer inserciones de motos en la bbdd
    public function store(Request $request){
        return $this->saveMoto($request, null);
    }

    //metodo para hacer updates de motos en la bbdd
    public function update(Request $request, $idMoto){
        //se obitene la moto por el id
        $moto = Moto::find($idMoto);
        //llama al metodo saveMoto para guardar los datos actualizados de la moto
        $this->saveMoto($request, $idMoto);
    
        //recupera la url anterior de la sesion
        $previousUrl = $request->session()->get('previous_url');
    
        //redirige al usuario de vuelta a la url anterior
        return redirect($previousUrl);
    }
    
    //metodo para guardar los datos de una moto, ya sea creando una nueva o actualizando una existente
    public function saveMoto(Request $request, $idMoto){
        //verifica si se proporciona un id de moto para determinar si se está actualizando o creando una nueva
        if($idMoto){
            //se otiene la moto por id
            $moto = Moto::find($idMoto);
            //se guarda la ruta de la imagen existente para su posible eliminación posterior
            $oldImagePath = $moto->imagen;

        }else{
            //si no se proporciona un id se crea una nueva instancia de la clase Moto
            $moto = new Moto();
            //como es una moto nueva, la ruta de la imagen anterior se establece en null
            $oldImagePath = null;         
        }
        //se asignan los valores de los campos de la moto con los datos proporcionados en la solicitud
        $moto->idUsuario = $request->input('idUsuario');
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
        return redirect()->route('motos.index');
    }

    //metodo para cargar la vista del formulario de editar las motos
    public function edit($idMoto, Request $request){
        //obtiene el id de la moto seleccionada a editar
        $moto = Moto::find($idMoto);
    
        //en caso de acceder por url a una moto que no existe nos redirige al index
        if(!$moto){
            return $this->index();
        }
    
        //se obtienen todos los usuarios para cargarlos en el select
        $users = User::all();
    
        //almacena la URL anterior en la sesión para facilitar la redirección posterior
        $request->session()->put('previous_url', url()->previous());
    
        return view('auth.admin.motos.edit', ['moto' => $moto, 'users' => $users]);
    }
    
    //metodo para borrar registros
    public function destroy(string $idMoto){
        //obtiene el id de la moto seleccionada a borrar
        $moto = Moto::find($idMoto);

        //almacena la ruta de la imagen asociada a la moto
        $imagePath = $moto->imagen;

        //elimina la moto de la base de datos
        $moto ->delete();

        //en caso de que hubiese una foto asociada a la moto se elimina del sistema de archivos
        if ($imagePath) {
            File::delete(public_path($imagePath));
        }

        return redirect()->back();
    }

    //metodo para borrar varios registros a la vez
    public function deleteMultiple(Request $request) {
        //obtiene los ids de las motos seleccionadas
        $selectedMotoIds = $request->input('selectedMotos');

        //verifica si no se han seleccionado motos, y en ese caso, redirige de vuelta
        if (empty($selectedMotoIds)) {
            return redirect()->back();
        }

        //obtiene las rutas de las imágenes asociadas a las motos seleccionadas
        $imagePaths = Moto::whereIn('idMoto', $selectedMotoIds)->pluck('imagen');

        //elimina las imagenes asociadas a las motos seleccionadas del sistema de archivos
        foreach ($imagePaths as $imagePath) {
            if ($imagePath) {
                File::delete(public_path($imagePath));
            }
        }
    
        //elimina las motos seleccionadas de la base de datos
        Moto::whereIn('idMoto', $selectedMotoIds)->delete();
    
        return redirect()->back();
    }
    
}
