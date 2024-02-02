<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function index()
    {
        $user = auth('sanctum')->check();
        if ($user) {

            $user_id = auth('sanctum')->user()->id;
            $task = Task::where('user_id', $user_id)->get();
            if ($task) {

                return response()->json([
                    'task' => $task
                ]);
            }
        }
    }

    public function show($task)
    {
        // return new TaskResource($task);
        $task = Task::find($task);
        if ($task) {
            return response()->json([
                'task' => $task
            ]);
        }
    }


    public function store(Request $request)
    {

        $user = auth('sanctum')->check();
        if ($user) {
            $user_id = auth('sanctum')->user()->id;

            $validated = $request->validate([
                'title' => 'required|max:255',
                'body' => 'required|max:255'
            ]);

            $task = Task::create(['title' => $validated['title'], 'body' => $validated['body'], 'user_id' => $user_id,]);

            $response = [
                'task' => $task,
                "message" => "Task Saved",
                "status" => 201
            ];
            return response($response);
        } else {
            $response = [

                "message" => "Not Logged in",
                "status" => 500
            ];
            return response($response);
        }
    }

    public function update(Request $request,  $id)
    {

        $fields = Validator::make($request->all(), [
            'title' => 'sometimes|required|',
            'is_done' => 'sometimes|required',
            'body' => 'sometimes|required',
        ]);


        if ($fields->fails()) {
            return response()->json([
                'status' => 422,
                "errors" => $fields->messages()
            ]);
        } else {
            $task = Task::find($id);
            if ($task) {

                $task->title = $request->input('title');
                $task->is_done = $request->input('is_done');
                $task->body = $request->input('body');
                $task->update();
                $response = [
                    'task' => $task,
                    'status' => 201,
                ];

                return response($response);
            }
        }
        /*  $validated = $request->validate([
            'title' => 'sometimes|required|max:255',
            'is_done' => 'sometimes|required',
            'body' => 'sometimes|required'
        ]); */
    }

    public function destroy(Request $request, Task $task)
    {
        $task->delete();
        return response()->noContent();
    }
}
