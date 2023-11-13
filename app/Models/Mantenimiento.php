<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $primaryKey = 'idMantenimiento';

    public function moto(){
        return $this->belongsTo(Moto::class, 'idMoto');
    }

    //habilita poder hacer updates de manera multiple
    protected $fillable = [
        'kilometraje',
        'kmAceiteMotor',
        'kmRuedaTrasera',
        'kmRuedaDelantera',
        'kmPastillaFrenoDelantero',
        'kmPastillaFrenoTrasero',
        'kmReglajeValvulas',
        'kmCadena',
        'kmRetenesHorquilla',
        'kmKitTransmision',
    ];
    
}
