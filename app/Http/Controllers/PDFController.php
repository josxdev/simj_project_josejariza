<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use App\Models\User;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    public function show(Request $request)
    {
        $viewData = [];

        $user = User::where('id', $request->get('userId'))->first()->toArray();
        $viewData['user'] = $user;


        $start = Carbon::parse($request->get('initDate'))->startOfDay();
        $end = Carbon::parse($request->get('endDate'))->endOfDay();
        $tasks = Task::select('tasks.*', 'projects.title as project_name')
            ->where('tasks.user_id', $user['id'])
            ->join('projects', 'projects.id', '=', 'tasks.project_id')
            ->where('start_time', '<', $end)
            ->where('end_time', '>', $start);

        if ($request->get('projectId') !== 'all')
            $tasks = $tasks->where('project_id', $request->get('projectId'));


        $tasks = $tasks->get()->toArray();

        $projects = [];

        foreach ($tasks as $task) {
            $projects[$task['project_id']]['name'] = $task['project_name'];
            $projects[$task['project_id']]['totalDuration'] = $projects[$task['project_id']]['totalDuration'] ?? 0;
            $projects[$task['project_id']]['tasks'] = $projects[$task['project_id']]['tasks'] ?? [];


            $durationTask = Carbon::parse($task['start_time'])->diffInMinutes(Carbon::parse($task['end_time']));
            $task['duration'] = $durationTask;

            $projects[$task['project_id']]['tasks'][] = $task;
            $projects[$task['project_id']]['totalDuration'] += $durationTask;
        }

        $viewData['projects'] = $projects;
        $projectsNames = array_unique(array_column($projects, 'name'));
        $viewData['data'] = [
            'project' => count($projectsNames) > 1 ? 'Todos' : $projectsNames[0] ?? '-',
            'user' => $user,
            'initDate' => $start->format('d/m/Y'),
            'endDate' => $end->format('d/m/Y'),
        ];

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        $html = view('pdf.tasks', $viewData)->render();

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        return $dompdf->stream('informe_simj.pdf', array("Attachment" => false));
    }
}
