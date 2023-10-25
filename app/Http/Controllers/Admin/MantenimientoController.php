<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mantenimiento;
use App\Models\Moto;


class MantenimientoController extends Controller
{
    public function index()
    {
        $mantenimientos = Mantenimiento::all();
        $motos = Moto::all();

        $totalMantenimientos = Mantenimiento::count();


        return view('auth.admin.mantenimientos.index',  ['mantenimientos'=>$mantenimientos, 'totalMantenimientos'=>$totalMantenimientos, 'motos'=>$motos]);
    }

    public function destroy(string $idMantenimiento){
        $mantenimiento = Mantenimiento::find($idMantenimiento);

        $mantenimiento ->delete();

        return redirect()->route('mantenimientos.index');
    }
}