<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            box-sizing: border-box;
        }

        button, a {
            padding: 10px 15px;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Task</h1>

    <form action="/tasks/{{ $task->id }}" method="POST">
        @csrf
        @method('PUT')

        <label>Task Name</label>
        <input type="text" name="task_name" value="{{ $task->task_name }}" required>

        <label>Description</label>
        <textarea name="description">{{ $task->description }}</textarea>

        <label>Status</label>
        <select name="status">
            <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>
                Pending
            </option>
            <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>
                Completed
            </option>
        </select>

        <label>Due Date</label>
        <input type="date" name="due_date" value="{{ $task->due_date }}">

        <button type="submit">Update Task</button>

        <a href="/">Cancel</a>
    </form>

</div>

</body>
</html>