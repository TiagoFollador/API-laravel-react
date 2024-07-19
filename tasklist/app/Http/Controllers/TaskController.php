<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\ListTaskRequest;
use App\Services\ProjectService;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public  function __construct( protected TaskService $taskService){}

    public function index()
    {
        $projects = (new ProjectService())->getAll();
        return view('tasks.index', [
            'projects' => $projects,
        ]);
    }

    public function list(ListTaskRequest $request): JsonResponse
    {
        $tasks = $this->taskService->list($request->get('project_id'));

        return response()->json([
            'sucess' => true,
            'tasks' => $tasks,
            'message' => "Tasks retrived succesfully",
        ]);
    }
}
