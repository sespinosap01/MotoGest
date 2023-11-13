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
    //metodo que carga la ficha de mantenimiento de la moto
    public function index($idMoto){
        $moto = Moto::find($idMoto);
        //si un usuario accede a una moto que no existe por la url
        if($moto){ 
            //si la moto no pertenece al usuario autenticado
            if ($moto->idUsuario !== auth()->user()->idUsuario) {
                return abort(403); 
            }
        }else{
            //si la moto no existe, obtiene el usuario autenticado y sus motos
            $user = Auth::user();
            $motos = $user->motos;
            return view('clientes.clientPanel', compact('motos'));
        }
        
        //busca un registro de mantenimiento asociado a la moto
        $mantenimiento = Mantenimiento::where('idMoto', $idMoto)->first();
    
        //si no hay registro de mantenimiento, crea uno nuevo asociado a la moto
        if (!$mantenimiento) {
            $nuevoMantenimiento = new Mantenimiento();
            $nuevoMantenimiento->idMoto = $idMoto;
            $nuevoMantenimiento->save();
            return view("clientes.fichas.index", ['mantenimiento' => $nuevoMantenimiento,  'moto' => $moto ]);
        }
        return view("clientes.fichas.index", ['mantenimiento' => $mantenimiento, 'moto' => $moto ]);
    }

    //metodo para sumar gastos
    public function agregarGastos(Request $request, $idMoto) {
        //busca la instancia de la moto con el id proporcionado
        $moto = Moto::find($idMoto);
    
        //verifica si la moto no pertenece al usuario autenticado
        if ($moto->idUsuario !== auth()->user()->idUsuario) {
            return abort(403); 
        }
        
        //busca el registro de mantenimiento asociado a la moto
        $mantenimiento = Mantenimiento::where('idMoto', $idMoto)->first();

        //obtiene la cantidad de gastos introducidos y en caso de ser menos de 0 se convierte en 0
        $nuevosGastos = max(0, $request->input('sumarGastos'));

        //suma los nuevos gastos al total de gastos en el mantenimiento
        $mantenimiento->gastosGeneral += $nuevosGastos;
        $mantenimiento->save();
    
        return redirect()->route('fichas.index', ['idMoto' => $idMoto]);

    }
    
    //metodo para sumar kilometraje
    public function sumarKilometraje(Request $request, $idMoto) {
        //busca la instancia de la moto con el id proporcionado
        $moto = Moto::find($idMoto);
    
        //verifica si la moto no pertenece al usuario autenticado
        if ($moto->idUsuario !== auth()->user()->idUsuario) {
            return abort(403); 
        }
    
        //obtiene el kilometraje introducido y en caso de ser menos de 0 se convierte en 0
        $nuevoCampo = max(0, $request->input('kilometraje'));

        $mantenimiento = Mantenimiento::where('idMoto', $idMoto)->first();
    
        //maneja el caso en el que no se encuentre el mantenimiento
        if (!$mantenimiento) {
            return abort(404); 
        }
    
        //actualiza los campos de kilometraje en el registro de mantenimiento
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
    
    //metodo para actualizar los campos
    public function updateCampos(Request $request, $idMoto, $field) {
        //busca la instancia de la moto con el id proporcionado
        $moto = Moto::find($idMoto);
    
        //verifica si la moto no pertenece al usuario autenticado
        if ($moto->idUsuario !== auth()->user()->idUsuario) {
            return abort(403);
        }

        //obtiene el kilometraje introducido y en caso de ser menos de 0 se convierte en 0
        $nuevoCampo = max(0, $request->input('nuevoCampo'));

        //busca el registro de mantenimiento asociado a la moto
        $mantenimiento = Mantenimiento::where('idMoto', $idMoto)->first();
    
        //maneja el caso en el que no se encuentre el mantenimiento
        if (!$mantenimiento) {
            return abort(404);
        }
    
        //actualiza el campo especificado en el registro de mantenimiento
        $mantenimiento->$field = $nuevoCampo;
        $mantenimiento->save();
    
        return redirect()->route('fichas.index', ['idMoto' => $idMoto]);
    }
    
    public function updateKilometrajeMultiple(Request $request, $idMoto) {
        //busca la instancia de la moto con el id proporcionado
        $moto = Moto::find($idMoto);
    
        //verifica si la moto no pertenece al usuario autenticado
        if ($moto->idUsuario !== auth()->user()->idUsuario) {
            return abort(403);
        }
    
        //busca el registro de mantenimiento asociado a la moto
        $mantenimiento = Mantenimiento::where('idMoto', $idMoto)->first();
    
        //maneja el caso en el que no se encuentre el mantenimiento
        if (!$mantenimiento) {
            return abort(404);
        }
    
        //actualiza los campos de kilometraje en el registro de mantenimiento
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
