<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Task - Personal Task Manager</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6fb;
            color: #1e293b;
            min-height: 100vh;
        }

        /* HEADER */
        .header {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 45px 20px;
        }

        .header-content {
            max-width: 700px;
            margin: auto;
        }

        .header h1 {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .header p {
            color: #e0e7ff;
            font-size: 15px;
        }

        /* CONTAINER */
        .container {
            max-width: 700px;
            margin: 35px auto;
            padding: 0 20px;
        }

        /* CARD */
        .card {
            background: white;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.08);
            border: 1px solid #e2e8f0;
        }

        .card h2 {
            font-size: 24px;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .card-description {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 25px;
        }

        /* FORM */
        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            font-size: 14px;
            background: #f8fafc;
            color: #1e293b;
            outline: none;
            transition: 0.2s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #6366f1;
            background: white;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* ERRORS */
        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        /* BUTTONS */
        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .update-button,
        .cancel-button {
            padding: 12px 20px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .update-button {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            border: none;
            flex: 1;
        }

        .update-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(79, 70, 229, 0.25);
        }

        .cancel-button {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
            text-align: center;
        }

        .cancel-button:hover {
            background: #e2e8f0;
        }

        /* MOBILE */
        @media (max-width: 600px) {
            .header {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 27px;
            }

            .container {
                margin: 25px auto;
                padding: 0 15px;
            }

            .card {
                padding: 22px;
            }

            .buttons {
                flex-direction: column;
            }

            .update-button,
            .cancel-button {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <div class="header-content">
            <h1>✏️ Edit Task</h1>
            <p>Update your task information and keep your work organized.</p>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="container">

        <div class="card">

            <h2>Update Task</h2>

            <p class="card-description">
                Change the details of your task below.
            </p>

            <form action="/tasks/{{ $task->id }}" method="POST">

                @csrf
                @method('PUT')

                <!-- TASK NAME -->
                <div class="form-group">
                    <label for="task_name">Task Name</label>

                    <input
                        type="text"
                        id="task_name"
                        name="task_name"
                        value="{{ old('task_name', $task->task_name) }}"
                        placeholder="Enter task name"
                        required
                    >

                    @error('task_name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- DESCRIPTION -->
                <div class="form-group">
                    <label for="description">Description</label>

                    <textarea
                        id="description"
                        name="description"
                        placeholder="Enter task details"
                    >{{ old('description', $task->description) }}</textarea>

                    @error('description')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- STATUS -->
                <div class="form-group">
                    <label for="status">Status</label>

                    <select id="status" name="status">

                        <option
                            value="Pending"
                            {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option
                            value="Completed"
                            {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}>
                            Completed
                        </option>

                    </select>

                    @error('status')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- DUE DATE -->
                <div class="form-group">
                    <label for="due_date">Due Date</label>

                    <input
                        type="date"
                        id="due_date"
                        name="due_date"
                        value="{{ old('due_date', $task->due_date) }}"
                    >

                    @error('due_date')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- BUTTONS -->
                <div class="buttons">

                    <button
                        type="submit"
                        class="update-button">
                        ✓ Update Task
                    </button>

                    <a
                        href="/"
                        class="cancel-button">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>