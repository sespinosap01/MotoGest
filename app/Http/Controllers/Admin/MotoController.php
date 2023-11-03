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

    public function edit($idMoto){
        $moto = Moto::find($idMoto);

        $users = User::all();
        
        return view('auth.admin.motos.edit', ['moto' => $moto], ['users' => $users]);
    }

    public function destroy(string $idMoto){
        $moto = Moto::find($idMoto);

        $imagePath = $moto->imagen;

        $moto ->delete();

        if ($imagePath) {
            File::delete(public_path($imagePath));
        }

        return redirect()->route('motos.index');
    }
}
