<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .task {
            background: white;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .task h2 {
            margin-top: 0;
        }

        .status {
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Personal Task Manager</h1>
    <div class="task">
    <h2>Add New Task</h2>

    <form action="/tasks" method="POST">
        @csrf

        <label>Task Name</label><br>
        <input type="text" name="task_name" required><br><br>

        <label>Description</label><br>
        <textarea name="description"></textarea><br><br>

        <label>Status</label><br>
        <select name="status">
            <option value="Pending">Pending</option>
            <option value="Completed">Completed</option>
        </select><br><br>

        <label>Due Date</label><br>
        <input type="date" name="due_date"><br><br>

        <button type="submit">Add Task</button>
    </form>
</div>


    @forelse ($tasks as $task)

        <div class="task">
            <h2>{{ $task->task_name }}</h2>

            <p>{{ $task->description }}</p>

            <p class="status">
                Status: {{ $task->status }}
            </p>

            <p>
                Due Date: {{ $task->due_date ?? 'No due date' }}
                <p>
                <a href="/tasks/{{ $task->id }}/edit">Edit</a>
                <form action="/tasks/{{ $task->id }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>
            
        </div>

    @empty

        <div class="task">
            <p>No tasks yet.</p>
        </div>

    @endforelse

</div>

</body>
</html>