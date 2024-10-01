<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Listado de proyectos (vista)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $viewData = ['title' => 'Proyectos'];

        return view('Projects.index', $viewData);
    }

    /**
     * Obtener el listado de proyectos mediante API
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexAPI()
    {
        $projects = Project::select('projects.*', 'users.name as creator_name')
            ->join('users', 'projects.owner_user_id', 'users.id')->orderBy('created_at', 'asc')->get()->toArray();

        return response()->json($projects);
    }

    /**
     * Guardado del proyecto en la base de datos según parámetros del request
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function store(Request $request)
    {

        $data = $request->validate(
            [
                'title' => 'required|max:50',

            ],
            [
                'required' => 'No puede estar vacío',
                'max' => 'No puede alcanzar más de :max caracteres',
            ]
        );

        // Creación del proyecto
        Project::create([
            'title' => $data['title'],
            'owner_user_id' => session()->get('user')['id']
        ]);

        return response()->json('Proyecto creado', 200);
    }
}
