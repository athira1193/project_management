<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeToTask;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Carbon;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TimeToTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $task = TimeToTask::latest()->with('project')->with('task')->paginate(10);
        return response()->json([
            'success' => true,
            'message' => 'Task Time Listed successfully',
            'data' => $task
        ], Response::HTTP_OK);
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
        $data = $request->only('project_id', 'task_id', 'description', 'hours', 'date');
        $validator = Validator::make($data, [
            'project_id' => 'required',
            'task_id' => 'required',
            'description' => 'required',
            'hours' => 'required',
            'date' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        $formated_date = Carbon::createFromTimestamp(strtotime($request->date))->format('Y-m-d');
        $add_time_to_task = new TimeToTask;
        $add_time_to_task->project_id = $request->project_id;
        $add_time_to_task->task_id = $request->task_id;
        $add_time_to_task->description = $request->description;
        $add_time_to_task->hours = $request->hours;
        $add_time_to_task->date = $formated_date;
        $add_time_to_task->save();
        return response()->json([
            'success' => true,
            'message' => 'Time Added successfully',
            'data' => $add_time_to_task
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function Report()
    {

        //$data = DB::table('projects')->join('time_to_tasks','projects.id','=','time_to_tasks.project_id')->groupBy('projects.id')->sum('hours');
        $project = Project::get();
        // dd($project);
        $deliveries = $project->map(function($da) {
            $project_name = $da->project_name;
            $tasks = Task::where('project_id',$da->id)->get()->map(function($tsk) {
                $task_time = TimeToTask::where('task_id', $tsk->id)->get()->sum('hours');
                return [
                    'task_name' => $tsk->task_name,
                    'total_task_hour'=> $task_time
                ];
            });  
            return [
                'projectName' => $project_name,
                'tasks' => $tasks,
                'total_hour' => $tasks->sum('total_task_hour')
            ];
        });    
        return response()->json([
            'success' => true,
            'message' => 'Task Report Listed successfully',
            'data' => $deliveries
        ], Response::HTTP_OK);
    }
}
