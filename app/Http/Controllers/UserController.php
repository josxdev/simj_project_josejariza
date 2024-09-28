<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->validate(
            [
                'name' => 'required|max:50',
                'email' => 'required|email|unique:users,email,max:150',
                'password' => [
                    'min:8',
                    'confirmed',
                    'required',
                ],
            ],
            [
                'required' => 'No puede estar vacío',
                'email.unique' => 'Este correo ya está siendo utilizado por una cuenta',
                'max' => 'No puede alcanzar más de :max caracteres',
                'min' => 'Debe tener al menos :min caracteres',
                'email' => 'Debe de ser un email válido',
                'confirmed' => 'Las contraseñas no coinciden',
            ]
        );

        User::create($user);

        return Redirect::route('desktop');

    }

    public function auth(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'Debes introducir tu correo electrónico',
                'password.required' => 'Debes introducir tu contraseña'
            ]);


        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            session()->put(['user' => $user]);
            return Redirect::route('desktop');
        }

        return back()->withErrors([
            'credentials' => 'Las credenciales no son correctas'
        ]);

    }
}
