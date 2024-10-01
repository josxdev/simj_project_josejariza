<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Obtener listado de tareas mediante API
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
        ]);

        $userId = $request->input('user_id');
        $date = $request->input('date');

        // Obtener todas las tareas del usuario en la fecha seleccionada
        $tasks = Task::where('user_id', $userId)
            ->whereDate('start_time', $date)
            ->get();

        return response()->json($tasks);
    }


    /**
     * Guardado de tareas según parámetros del request
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
            'description' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        // Crear la nueva tarea
        Task::create($inputs);

        return response()->json([], 200);
    }
}
