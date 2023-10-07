<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;

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

    }
}
