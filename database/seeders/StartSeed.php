<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;
use App\Models\User;


class StartSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRol = new Rol();
        $userRol->name="User";
        $userRol->save();

        $adminRol = new Rol();
        $adminRol->name="Admin";
        $adminRol->save();

        $userSeed = new User();
        $userSeed->nombre="Admin";
        $userSeed->email="admin@gmail.com";
        $userSeed->password="12345678";
        $userSeed->fechaNacimiento="2000-01-01";
        $userSeed->numTelefono="609366343";
        $userSeed->rol_id="2";
        $userSeed->save();

        $userSeed2 = new User();
        $userSeed2->nombre="Sergio Espinosa";
        $userSeed2->email="sespinosap05@iesalbarregas.es";
        $userSeed2->password="12345678";
        $userSeed2->fechaNacimiento="2000-01-01";
        $userSeed2->numTelefono="678976345";
        $userSeed2->rol_id="1";
        $userSeed2->save();
    }
}
