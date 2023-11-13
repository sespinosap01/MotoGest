<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Moto;

class MotoPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

/*     Este código define una política en Laravel que permite la actualización de una instancia 
    de moto solo si el usuario autenticado es el propietario de esa moto. */
    public function update(User $user, Moto $moto)
{
    return $user->idUsuario === $moto->idUsuario;
}

}
