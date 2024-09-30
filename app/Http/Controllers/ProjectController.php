<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viewData = ['title' => 'Proyectos'];


//        $viewData['users'] = $users;

        return view('Projects.index', $viewData);
    }

    public function indexAPI()
    {
        $projects = Project::select('projects.*', 'users.name as creator_name')
            ->join('users', 'projects.owner_user_id', 'users.id')->orderBy('created_at', 'asc')->get()->toArray();

        return response()->json($projects);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
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

        Project::create([
            'title' => $data['title'],
            'owner_user_id' => session()->get('user')['id']
        ]);

        return response()->json('Proyecto creado', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
