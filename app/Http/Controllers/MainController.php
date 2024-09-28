<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function signin()
    {
        $viewData = ['title' => 'Iniciar sesión'];
        return view('Access.signin', $viewData);
    }
    public function signup()
    {
        $viewData = ['title' => 'Registrarse'];
        return view('Access.signup', $viewData);
    }

    public function desktop()
    {
        $viewData = ['title' => 'Escritorio'];
        return view('Desktop.index', $viewData);
    }
}
