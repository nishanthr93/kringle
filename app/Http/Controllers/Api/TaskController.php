<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Models\Roles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->tokenCan('task-index')) {
            abort(403, 'Not Unauthorized');
        }

        if ((auth()->user()->role_id == Roles::IS_ADMIN) || (auth()->user()->role_id == Roles::IS_MANAGER)) {
            $tasks = Task::paginate(5);
        } else {
            $tasks = auth()->user()->task()->paginate(5);
        }
        
        return new TaskResource($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->tokenCan('task-store')) {
            abort(403, 'Not Unauthorized');
        }

        $this->validate($request, [
            'user_id' => 'required|not_in:0',
            'task_description' => 'required',
        ]);

        $task = Task::Create([
            'user_id' => $request->user_id,
            'task_description' => $request->task_description,
        ]);

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        if (!auth()->user()->tokenCan('task-show')) {
            abort(403, 'Not Unauthorized');
        }
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        if (!auth()->user()->tokenCan('task-update')) {
            abort(403, 'Not Unauthorized');
        }

        $this->validate($request, [
            'user_id' => 'required|not_in:0',
            'task_description' => 'required',
        ]);

        $task->update($request->all());

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if (!auth()->user()->tokenCan('task-destroy')) {
            abort(403, 'Not Unauthorized');
        }

        $task->delete();

        return new TaskResource([
            "status" => "Task deleted Successfully"
        ]);
    }
}
