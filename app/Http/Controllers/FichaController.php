<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mantenimiento;
use App\Models\Moto;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FichaController extends Controller
{
    public function index($idMoto){
        $moto = Moto::find($idMoto);
    
        if($moto){ //si un usuario accede a una moto que no existe por la URL
            if ($moto->idUsuario !== auth()->user()->idUsuario) {
                return abort(403); //Si la moto no pertenece al usuario autenticado.
            }
        }else{
            $user = Auth::user();
            $motos = $user->motos;
            return view('clientes.clientPanel', compact('motos'));
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
   
        $nuevosGastos = max(0, $request->input('sumarGastos'));

    
        $mantenimiento->gastosGeneral += $nuevosGastos;
        $mantenimiento->save();
    
        return redirect()->route('fichas.index', ['idMoto' => $idMoto]);

    }
    
    public function sumarKilometraje(Request $request, $idMoto) {
        $moto = Moto::find($idMoto);
    
        if ($moto->idUsuario !== auth()->user()->idUsuario) {
            return abort(403); 
        }
    
        $nuevoCampo = max(0, $request->input('kilometraje'));

        $mantenimiento = Mantenimiento::where('idMoto', $idMoto)->first();
    
        if (!$mantenimiento) {
            return abort(404); // Maneja el caso en el que no se encuentre el mantenimiento.
        }
    
        $mantenimiento->update([
            'kilometraje' => $mantenimiento->kilometraje + $nuevoCampo,
            'kmAceiteMotor' => $mantenimiento->kmAceiteMotor + $nuevoCampo,
            'kmRuedaTrasera' => $mantenimiento->kmRuedaTrasera + $nuevoCampo,
            'kmRuedaDelantera' => $mantenimiento->kmRuedaDelantera + $nuevoCampo,
            'kmPastillaFrenoDelantero' => $mantenimiento->kmPastillaFrenoDelantero + $nuevoCampo,
            'kmPastillaFrenoTrasero' => $mantenimiento->kmPastillaFrenoTrasero + $nuevoCampo,
            'kmReglajeValvulas' => $mantenimiento->kmReglajeValvulas + $nuevoCampo,
            'kmCadena' => $mantenimiento->kmCadena + $nuevoCampo,
            'kmRetenesHorquilla' => $mantenimiento->kmRetenesHorquilla + $nuevoCampo,
            'kmKitTransmision' => $mantenimiento->kmKitTransmision + $nuevoCampo,
        ]);
    
        return redirect()->route('fichas.index', ['idMoto' => $idMoto]);
    }
    
    public function updateCampos(Request $request, $idMoto, $field) {
        $moto = Moto::find($idMoto);
    
        if ($moto->idUsuario !== auth()->user()->idUsuario) {
            return abort(403);
        }

        $nuevoCampo = max(0, $request->input('nuevoCampo'));

        $mantenimiento = Mantenimiento::where('idMoto', $idMoto)->first();
    
        if (!$mantenimiento) {
            return abort(404);
        }
    
        $mantenimiento->$field = $nuevoCampo;
        $mantenimiento->save();
    
        return redirect()->route('fichas.index', ['idMoto' => $idMoto]);
    }
    
    public function updateKilometrajeMultiple(Request $request, $idMoto) {
        $moto = Moto::find($idMoto);
    
        if ($moto->idUsuario !== auth()->user()->idUsuario) {
            return abort(403);
        }
    
        $mantenimiento = Mantenimiento::where('idMoto', $idMoto)->first();
    
        if (!$mantenimiento) {
            return abort(404);
        }
    
        $kmAceiteMotor = max(0, $request->input('kmAceiteMotor'));
        $kmRuedaTrasera = max(0, $request->input('kmRuedaTrasera'));
        $kmRuedaDelantera = max(0, $request->input('kmRuedaDelantera'));
        $kmPastillaFrenoDelantero = max(0, $request->input('kmPastillaFrenoDelantero'));
        $kmPastillaFrenoTrasero = max(0, $request->input('kmPastillaFrenoTrasero'));
        $kmReglajeValvulas = max(0, $request->input('kmReglajeValvulas'));
        $kmCadena = max(0, $request->input('kmCadena'));
        $kmRetenesHorquilla = max(0, $request->input('kmRetenesHorquilla'));
        $kmKitTransmision = max(0, $request->input('kmKitTransmision'));

        $mantenimiento->update([
            'kmAceiteMotor' => $kmAceiteMotor,
            'kmRuedaTrasera' => $kmRuedaTrasera,
            'kmRuedaDelantera' => $kmRuedaDelantera,
            'kmPastillaFrenoDelantero' => $kmPastillaFrenoDelantero,
            'kmPastillaFrenoTrasero' => $kmPastillaFrenoTrasero,
            'kmReglajeValvulas' => $kmReglajeValvulas,
            'kmCadena' => $kmCadena,
            'kmRetenesHorquilla' => $kmRetenesHorquilla,
            'kmKitTransmision' => $kmKitTransmision
        ]);
        return redirect()->route('fichas.index', ['idMoto' => $idMoto]);
    }
    
}
