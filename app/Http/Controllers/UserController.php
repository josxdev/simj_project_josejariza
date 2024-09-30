<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        $viewData = ['title' => 'Listado de usuarios'];

        $users = User::all()->where('id', '!=', session()->get('user')['id'])->toArray();
        $viewData['users'] = $users;

        return view('Users.index', $viewData);
    }

    public function show($id)
    {
        $viewData = ['title' => 'Listado de usuarios'];
        $viewData['user'] = User::where('id', $id)->first();

        return view('Users.show', $viewData);
    }

    public function logout()
    {
        session()->flush();
        session()->regenerate();
        return redirect()->route('signin');
    }
    public function indexAPI()
    {
        $users = User::all()->toArray();
        return response()->json(['users' => $users], 200);
    }
    public function create()
    {
        $viewData = ['title' => 'Añadir usuario'];
        return view('Users.create', $viewData);
    }
    public function store(Request $request)
    {
        $user = $request->validate(
            [
                'name' => 'required|max:50',
                'email' => 'required|email|unique:users,email,max:150',
                'password' => [
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

        $user = User::create($user);
        session()->put(['user' => $user]);

        return Redirect::route('desktop');
    }

    public function update($id, Request $request)
    {
        $user = $request->validate(
            [
                'name' => 'required|max:50',
                'email' => "required|email|unique:users,email,{$id}|max:150",

            ],
            [
                'required' => 'No puede estar vacío',
                'email.unique' => 'Este correo ya está siendo utilizado por una cuenta',
                'max' => 'No puede alcanzar más de :max caracteres',
                'min' => 'Debe tener al menos :min caracteres',
                'email' => 'Debe de ser un email válido',
            ]
        );

        $request->has('isAdmin') && $request['isAdmin'] === 'on' ? $user['is_admin'] = true : $user['is_admin'] = false;

        User::where('id', $id)->update($user);

        return redirect()->back()->with('success', 'Usuario actualizado');
    }

    public function storeManually(Request $request)
    {
        $user = $request->validate(
            [
                'name' => 'required|max:50',
                'email' => 'required|email|unique:users,email,max:150',
                'password' => [
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

        if ($request->has('isAdmin') && $request['isAdmin'] === 'on') $user['is_admin'] = true;
        else $user['is_admin'] = false;

        $user = User::create($user);

        return Redirect::route('user.index');

    }

    public function destroy($id)
    {
        User::destroy($id);
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
