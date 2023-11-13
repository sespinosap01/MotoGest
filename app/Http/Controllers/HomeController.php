<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //comentado el middleware para poder acceder al home sin necesidad de iniciar sesión
        //$this->middleware('auth');    
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminPanel()
    {
        return view('auth.adminPanel');
    }
}
