<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mantenimiento;
use App\Models\Moto;
use Illuminate\Http\Request;

class FichaController extends Controller
{
    public function index($idMoto){
        $moto = Moto::find($idMoto);
    
        if ($moto->idUsuario !== auth()->user()->idUsuario) {
            return abort(403); //Si la moto no pertenece al usuario autenticado.
        }

        $mantenimiento = Mantenimiento::where('idMoto', $idMoto)->first();
    
        if (!$mantenimiento) {
            $nuevoMantenimiento = new Mantenimiento();
            $nuevoMantenimiento->idMoto = $idMoto;
            $nuevoMantenimiento->save();
            return view("clientes.fichas.index", ['mantenimiento' => $nuevoMantenimiento,  'moto' => $moto ]);
        }
        return view("clientes.fichas.index", ['mantenimiento' => $mantenimiento, 'moto' => $moto ]);
    }

    public function agregarGastos(Request $request, $idMoto) {
        $moto = Moto::find($idMoto);
    
        if ($moto->idUsuario !== auth()->user()->idUsuario) {
            return abort(403); 
        }
        
        $mantenimiento = Mantenimiento::where('idMoto', $idMoto)->first();
   
        $nuevosGastos = $request->input('sumarGastos');
    
        $mantenimiento->gastosGeneral += $nuevosGastos;
        $mantenimiento->save();
    
        return redirect()->route('fichas.index', ['idMoto' => $idMoto]);

    }
    
    public function sumarKilometraje(Request $request, $idMoto) {
        $moto = Moto::find($idMoto);
    
        if ($moto->idUsuario !== auth()->user()->idUsuario) {
            return abort(403); 
        }
    
        $nuevoKilometraje = $request->input('kilometraje');
    
        $mantenimiento = Mantenimiento::where('idMoto', $idMoto)->first();
    
        if (!$mantenimiento) {
            return abort(404); // Maneja el caso en el que no se encuentre el mantenimiento.
        }
    
        $mantenimiento->update([
            'kilometraje' => $mantenimiento->kilometraje + $nuevoKilometraje,
            'kmAceiteMotor' => $mantenimiento->kmAceiteMotor + $nuevoKilometraje,
            'kmRuedaTrasera' => $mantenimiento->kmRuedaTrasera + $nuevoKilometraje,
            'kmRuedaDelantera' => $mantenimiento->kmRuedaDelantera + $nuevoKilometraje,
            'kmPastillaFrenoDelantero' => $mantenimiento->kmPastillaFrenoDelantero + $nuevoKilometraje,
            'kmPastillaFrenoTrasero' => $mantenimiento->kmPastillaFrenoTrasero + $nuevoKilometraje,
            'kmReglajeValvulas' => $mantenimiento->kmReglajeValvulas + $nuevoKilometraje,
            'kmCadena' => $mantenimiento->kmCadena + $nuevoKilometraje,
            'kmRetenesHorquilla' => $mantenimiento->kmRetenesHorquilla + $nuevoKilometraje,
            'kmKitTransmision' => $mantenimiento->kmKitTransmision + $nuevoKilometraje,
        ]);
    
        return redirect()->route('fichas.index', ['idMoto' => $idMoto]);
    }
    
    
}
