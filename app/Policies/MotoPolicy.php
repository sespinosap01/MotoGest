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

    public function update(User $user, Moto $moto)
{
    return $user->idUsuario === $moto->idUsuario;
}

}
