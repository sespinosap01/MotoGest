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

    public function destroy(string $idMoto){
        $moto = Moto::find($idMoto);

        $moto ->delete();

        return redirect()->route('clientes.clientPanel');
    }
}
