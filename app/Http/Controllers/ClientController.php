<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function clientPanel()
    {
        return view('clientes.clientPanel');
    }
}
