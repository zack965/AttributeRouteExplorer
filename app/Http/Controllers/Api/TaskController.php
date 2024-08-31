<?php

namespace App\Http\Controllers\Api;

use App\Attributes\GroupRoute;
use App\Attributes\Route;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\EditTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;


#[GroupRoute("tasks", "group of api to manage tasks actions")]
class TaskController extends Controller
{
    #[Route(description: "list tasks", method: "GET", path: "/tasks")]
    public function index()
    {
        return response()->json(["data" => Task::all()]);
    }
    #[Route(description: "Add tasks", method: "POST", path: "/tasks", request: ["description" => "description", "title" => "title"])]
    public function store(CreateTaskRequest $request)
    {

        $validatedData = $request->only(["description", "title"]);
        $task = Task::create($validatedData);

        return response()->json($task, 201);
    }

    #[Route(description: "Update tasks", method: "PUT", path: "/tasks/{id}", parameters: ["id" => "number"], request: ["description" => "description", "title" => "title"])]
    public function update(EditTaskRequest $request, string $id)
    {
        //
        $validatedData = $request->only(["description", "title"]);


        $task = Task::findOrFail($id);
        $task->update($validatedData);

        return response()->json($task);
    }

    #[Route(description: "DELETE tasks", method: "DELETE", path: "/tasks/{id}", parameters: ["id" => "number"])]
    public function destroy(string $id)
    {
        //
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(null, 204);
    }
}
