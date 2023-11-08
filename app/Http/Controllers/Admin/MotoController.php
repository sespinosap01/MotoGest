<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Moto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class MotoController extends Controller
{
    public function index()
    {
        $motos = Moto::paginate(10); 
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

    public function update(Request $request, $idMoto){
        $moto = Moto::find($idMoto);
    
        $this->saveMoto($request, $idMoto);
    
        // Recupera la URL anterior de la sesión.
        $previousUrl = $request->session()->get('previous_url');
    
        // Redirige al usuario de vuelta a la URL anterior.
        return redirect($previousUrl);
    }
    

    public function saveMoto(Request $request, $idMoto){
        if($idMoto){
            $moto = Moto::find($idMoto);
            $oldImagePath = $moto->imagen;

        }else{
            $moto = new Moto();   
            $oldImagePath = null;
         
        }

        $moto->idUsuario = $request->input('idUsuario');
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
        return redirect()->route('motos.index');
    }

    public function edit($idMoto, Request $request){
        $moto = Moto::find($idMoto);
    
        if(!$moto){
            return $this->index();
        }
    
        $users = User::all();
    
        $request->session()->put('previous_url', url()->previous());
    
        return view('auth.admin.motos.edit', ['moto' => $moto, 'users' => $users]);
    }
    

    public function destroy(string $idMoto){
        $moto = Moto::find($idMoto);

        $imagePath = $moto->imagen;

        $moto ->delete();

        if ($imagePath) {
            File::delete(public_path($imagePath));
        }

        return redirect()->back();
    }
}
