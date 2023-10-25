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
}