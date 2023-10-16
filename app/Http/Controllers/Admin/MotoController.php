<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Moto;
use Illuminate\Http\Request;

class MotoController extends Controller
{
    public function index()
    {
        $motos = Moto::all();

        return view('auth.admin.motos.index', ['motos'=>$motos]);
    }

    public function destroy(string $idMoto){
        $moto = Moto::find($idMoto);

        $moto ->delete();

        return redirect()->route('motos.index');
    }
}
