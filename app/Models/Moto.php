<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    use HasFactory;

    protected $primaryKey = 'idMoto';


    public function usuario(){
        return $this->belongsTo(User::class, 'idUsuario');
    }
    
}
