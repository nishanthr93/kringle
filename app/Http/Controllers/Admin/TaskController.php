<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('adminsOnly', Task::class);

        $tasks = Task::paginate(5);
        return view('tasks.list', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Task::class);

        $user = User::where('role_id', '!=', Roles::IS_ADMIN)
            ->where('role_id', '!=', Roles::IS_MANAGER)
            ->get();

        return view('tasks.index', [
            'users' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Task::class);

        $this->validate($request, [
            'user_id' => 'required|not_in:0',
            'task_description' => 'required',
        ]);

        Task::Create([
            'user_id' => $request->user_id,
            'task_description' => $request->task_description,
        ]);

        return redirect()
            ->route('admin.task.index')
            ->with('success', 'Task Created SuccessFully!!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $user = User::where('role_id', '!=', Roles::IS_ADMIN)
            ->where('role_id', '!=', Roles::IS_MANAGER)
            ->get();

        return view('tasks.edit', [
            'users' =>  $user,
            'task' => $task
        ]);
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
        $this->authorize('update', $task);

        $this->validate($request, [
            'user_id' => 'required|not_in:0',
            'task_description' => 'required',
        ]);

        $task->update($request->all());

        return redirect()
            ->route('admin.task.index')
            ->with('success', 'Task Updated SuccessFully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()
            ->route('admin.task.index')
            ->with('success', 'Task deleted successfully');
    }
}
