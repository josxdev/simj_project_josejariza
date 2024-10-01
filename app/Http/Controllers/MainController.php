<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Controlador para la vista de inicio de sesión
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function signin()
    {
        $viewData = ['title' => 'Iniciar sesión'];
        return view('Access.signin', $viewData);
    }

    /**
     * Controlador para el registro
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function signup()
    {
        $viewData = ['title' => 'Registrarse'];
        return view('Access.signup', $viewData);
    }
}
