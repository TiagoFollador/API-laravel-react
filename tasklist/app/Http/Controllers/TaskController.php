<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\ListTaskRequest;
use App\Http\Requests\Task\ReorderTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
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
        ]); // 200
    }

    public function store(CreateTaskRequest $request): JsonResponse
    {
        $this->taskService->store($request->all());

        return response()->json([
            'sucess' => true,
            'message' => "Task created succesfully"
        ], 201);
    }

    public function update(UpdateTaskRequest $request, int $id): JsonResponse
    {
        $this->taskService->update($id, $request->all());

        return response()->json([
            'success' => true,
            'message' => "Task update successfully",
        ], 201);
    }

    public function reorder(ReorderTaskRequest $request): JsonResponse
    {
        $this->taskService->reorder(
            $request->get('project_id'),
            $request->get('start'),
            $request->get('end'),
        );

        return response()->json([
            'success' => true,
            'message' => "Tasks reordered successfully",
        ], 201);
    } 
}
