<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // Show all tasks
    public function index()
    {
        $tasks = Task::latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    // Add task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,Completed',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Task added successfully!',
            'task' => $task,
        ], 201);
    }

    // Show edit page
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // Update task
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,Completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully!',
            'task' => $task->fresh(),
        ]);
    }

    // Delete task
    public function destroy(Task $task)
    {
        $taskId = $task->id;

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully!',
            'task_id' => $taskId,
        ]);
    }
}