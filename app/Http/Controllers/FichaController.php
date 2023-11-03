<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mantenimiento;
use App\Models\Moto;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
    
        $nuevoCampo = $request->input('kilometraje');
    
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

        $nuevoCampo = $request->input('nuevoCampo');
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
    
        $kmAceiteMotor = $request->input('kmAceiteMotor');
        $kmRuedaTrasera = $request->input('kmRuedaTrasera');
        $kmRuedaDelantera = $request->input('kmRuedaDelantera');
        $kmPastillaFrenoDelantero = $request->input('kmPastillaFrenoDelantero');
        $kmPastillaFrenoTrasero = $request->input('kmPastillaFrenoTrasero');
        $kmReglajeValvulas = $request->input('kmReglajeValvulas');
        $kmCadena = $request->input('kmCadena');
        $kmRetenesHorquilla = $request->input('kmRetenesHorquilla');
        $kmKitTransmision = $request->input('kmKitTransmision');

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
