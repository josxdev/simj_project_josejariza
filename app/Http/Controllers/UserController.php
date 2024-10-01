<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Scalar\String_;

class UserController extends Controller
{
    /**
     * Listado de usuarios (vista)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function index()
    {
        $viewData = ['title' => 'Listado de usuarios'];

        $users = User::all()->where('id', '!=', session()->get('user')['id'])->toArray();
        $viewData['users'] = $users;

        return view('Users.index', $viewData);
    }

    /**
     * Obtener información de un usuario mediante ID especificada en URL
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show($id)
    {
        $viewData = ['title' => 'Listado de usuarios'];
        $viewData['user'] = User::where('id', $id)->first();

        return view('Users.show', $viewData);
    }

    /**
     * Cierre de sesión
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        session()->flush();
        session()->regenerate();
        return redirect()->route('signin');
    }

    /**
     * Obtención del listado de usuarios mediante API
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexAPI()
    {
        $users = User::all()->toArray();
        return response()->json(['users' => $users], 200);
    }

    /**
     * Formulario de creación de usuarios
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $viewData = ['title' => 'Añadir usuario'];
        return view('Users.create', $viewData);
    }

    /**
     * Creación de un usuario validando información
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

        return Redirect::route('projects.index');
    }

    /**
     * Función para actualizar los datos de un usuario
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Creación de un usuario (no registro)
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Eliminar un usuario
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
        User::destroy($id);
    }

    /**
     * Verificación y autentificación de un usuario
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
            return Redirect::route('projects.index');
        }

        return back()->withErrors([
            'credentials' => 'Las credenciales no son correctas'
        ]);

    }
}
