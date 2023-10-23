<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mantenimiento;


class MantenimientoController extends Controller
{
    public function index()
    {
        $mantenimientos = Mantenimiento::all();


        return view('auth.admin.mantenimientos.index',  ['mantenimientos'=>$mantenimientos]);
    }
}
