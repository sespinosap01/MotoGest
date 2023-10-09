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
        $userSeed->nombre="admin";
        $userSeed->email="admin@gmail.com";
        $userSeed->password="12345678";
        $userSeed->fechaNacimiento="2000-01-01";
        $userSeed->rol_id="2";
        $userSeed->save();

    }
}
