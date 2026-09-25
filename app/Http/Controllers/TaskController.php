<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
{
    $request->validate([
        'task_name' => 'required',
        'description' => 'nullable',
        'status' => 'required',
        'due_date' => 'nullable|date',
    ]);

    Task::create([
        'task_name' => $request->task_name,
        'description' => $request->description,
        'status' => $request->status,
        'due_date' => $request->due_date,
    ]);

    return redirect('/');
}

public function edit(Task $task)
{
    return view('tasks.edit', compact('task'));
}

public function update(Request $request, Task $task)
{
    $request->validate([
        'task_name' => 'required',
        'description' => 'nullable',
        'status' => 'required',
        'due_date' => 'nullable|date',
    ]);

    $task->update([
        'task_name' => $request->task_name,
        'description' => $request->description,
        'status' => $request->status,
        'due_date' => $request->due_date,
    ]);

    return redirect('/');
}
public function destroy(Task $task)
{
    $task->delete();

    return redirect('/');
}
}