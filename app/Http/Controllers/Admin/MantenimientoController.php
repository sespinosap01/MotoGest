<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mantenimiento;
use App\Models\Moto;
use Illuminate\Http\Request;



class MantenimientoController extends Controller
{
    //metodo que carga la tabla paginada
    public function index()
    {
        //se obtienen los mantenimientos y las motos paginados
        $mantenimientos = Mantenimiento::paginate(10);
        $motos = Moto::paginate(10); 

        //se obtiene el total de registros de mantenimiento de la base de datos
        $totalMantenimientos = Mantenimiento::count();

        return view('auth.admin.mantenimientos.index',  ['mantenimientos'=>$mantenimientos, 'totalMantenimientos'=>$totalMantenimientos, 'motos'=>$motos]);
    }

    //metodo para eliminar registros
    public function destroy(string $idMantenimiento){
        //se busca el mantnimeinto por id
        $mantenimiento = Mantenimiento::find($idMantenimiento);

        //se elimina el mantenimiento
        $mantenimiento ->delete();

        return redirect()->back();
    }

    //metodo para eliminar varios registros a la vez
    public function deleteMultiple(Request $request) {
        //se obtienen los checkbox marcados para la eliminacion
        $selectedMantenimientoIds = $request->input('selectedMantenimientos');
    
        //en caso de no haberse marcado ninguno nos vuelve a redirigir donde estabamos
        if (empty($selectedMantenimientoIds)) {
            return redirect()->back();
        }
    
        //se borran los mantenimientos seleccionados con checkboxs
        Mantenimiento::whereIn('idMantenimiento', $selectedMantenimientoIds)->delete();
    
        return redirect()->back();
    }
}
