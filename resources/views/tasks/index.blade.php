<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Personal Task Manager</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #1e293b;
        }

        /* =========================
           HEADER
        ========================= */

        .header {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 45px 20px 75px;
        }

        .header-content {
            max-width: 1100px;
            margin: auto;
        }

        .logo {
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 1px;
            opacity: 0.85;
            margin-bottom: 12px;
        }

        .header h1 {
            font-size: 38px;
            margin-bottom: 10px;
        }

        .header p {
            color: #ddd6fe;
            font-size: 15px;
        }

        /* =========================
           MAIN
        ========================= */

        .container {
            max-width: 1100px;
            margin: -40px auto 50px;
            padding: 0 20px;
            position: relative;
        }

        /* =========================
           STATISTICS
        ========================= */

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.08);
            border: 1px solid #e5e7eb;
        }

        .stat-title {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 30px;
            font-weight: bold;
            color: #4f46e5;
        }

        /* =========================
           FORM
        ========================= */

        .form-card {
            background: white;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.07);
            border: 1px solid #e5e7eb;
            margin-bottom: 35px;
        }

        .form-title {
            font-size: 22px;
            margin-bottom: 6px;
            color: #111827;
        }

        .form-subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 7px;
            color: #334155;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background: #f9fafb;
            color: #1e293b;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            background: white;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        /* =========================
           ADD BUTTON
        ========================= */

        .add-button {
            margin-top: 20px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            border: none;
            padding: 13px 22px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: 0.2s;
        }

        .add-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(79, 70, 229, 0.25);
        }

        /* =========================
           TASK HEADER
        ========================= */

        .tasks-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .tasks-header h2 {
            font-size: 24px;
            color: #111827;
        }

        .task-count {
            background: #ede9fe;
            color: #5b21b6;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        /* =========================
           TASK GRID
        ========================= */

        .task-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .task-card {
            background: white;
            border-radius: 16px;
            padding: 23px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.06);
            transition: 0.25s;
        }

        .task-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.11);
        }

        .task-card h3 {
            font-size: 19px;
            color: #111827;
            margin-bottom: 9px;
        }

        .description {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 16px;
        }

        /* =========================
           STATUS
        ========================= */

        .status {
            display: inline-block;
            background: #fef3c7;
            color: #92400e;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .completed {
            background: #dcfce7;
            color: #166534;
        }

        /* =========================
           DUE DATE
        ========================= */

        .due-date {
            margin-top: 18px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            color: #64748b;
            font-size: 13px;
        }

        /* =========================
           ACTION BUTTONS
        ========================= */

        .actions {
            display: flex;
            gap: 9px;
            margin-top: 18px;
        }

        .edit-button,
        .delete-button {
            flex: 1;
            padding: 10px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
        }

        .edit-button {
            text-decoration: none;
            color: #4f46e5;
            background: #eef2ff;
            border: 1px solid #c7d2fe;
        }

        .edit-button:hover {
            background: #e0e7ff;
        }

        .delete-button {
            color: #dc2626;
            background: #fef2f2;
            border: 1px solid #fecaca;
        }

        .delete-button:hover {
            background: #fee2e2;
        }

        /* =========================
           EMPTY STATE
        ========================= */

        .empty {
            background: white;
            border-radius: 16px;
            padding: 55px 20px;
            text-align: center;
            border: 1px dashed #cbd5e1;
        }

        .empty-icon {
            font-size: 40px;
            margin-bottom: 12px;
        }

        .empty h3 {
            margin-bottom: 8px;
            color: #334155;
        }

        .empty p {
            color: #64748b;
            font-size: 14px;
        }

        /* =========================
           FOOTER
        ========================= */

        .footer {
            text-align: center;
            padding: 30px;
            color: #94a3b8;
            font-size: 13px;
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 700px) {

            .header {
                padding: 35px 20px 65px;
            }

            .header h1 {
                font-size: 29px;
            }

            .container {
                margin-top: -30px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: auto;
            }

            .task-grid {
                grid-template-columns: 1fr;
            }

            .tasks-header {
                gap: 10px;
            }
        }
    </style>
</head>

<body>

    <!-- =========================
         HEADER
    ========================= -->

    <header class="header">

        <div class="header-content">

            <div class="logo">
                ✦ TASK MANAGER
            </div>

            <h1>
                Personal Task Manager
            </h1>

            <p>
                Organize your tasks. Stay focused. Get things done.
            </p>

        </div>

    </header>


    <!-- =========================
         MAIN CONTENT
    ========================= -->

    <main class="container">


        <!-- =========================
             DASHBOARD STATISTICS
        ========================= -->

        @php

            $totalTasks = $tasks->count();

            $pendingTasks = $tasks
                ->where('status', 'Pending')
                ->count();

            $completedTasks = $tasks
                ->where('status', 'Completed')
                ->count();

        @endphp


        <section class="stats">


            <!-- TOTAL -->

            <div class="stat-card">

                <div class="stat-title">
                    TOTAL TASKS
                </div>

                <div class="stat-number">
                    {{ $totalTasks }}
                </div>

            </div>


            <!-- PENDING -->

            <div class="stat-card">

                <div class="stat-title">
                    PENDING
                </div>

                <div class="stat-number">
                    {{ $pendingTasks }}
                </div>

            </div>


            <!-- COMPLETED -->

            <div class="stat-card">

                <div class="stat-title">
                    COMPLETED
                </div>

                <div class="stat-number">
                    {{ $completedTasks }}
                </div>

            </div>


        </section>


        <!-- =========================
             ADD TASK FORM
        ========================= -->

        <section class="form-card">

            <h2 class="form-title">
                Create a New Task
            </h2>

            <p class="form-subtitle">
                Add a task and keep track of your progress.
            </p>


            <form action="/tasks" method="POST">

                @csrf


                <div class="form-grid">


                    <!-- TASK NAME -->

                    <div class="full">

                        <label for="task_name">
                            Task Name
                        </label>

                        <input
                            type="text"
                            id="task_name"
                            name="task_name"
                            placeholder="e.g. Finish Laravel project"
                            required
                        >

                    </div>


                    <!-- DESCRIPTION -->

                    <div class="full">

                        <label for="description">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            placeholder="Describe what you need to do..."
                        ></textarea>

                    </div>


                    <!-- STATUS -->

                    <div>

                        <label for="status">
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                        >

                            <option value="Pending">
                                Pending
                            </option>

                            <option value="Completed">
                                Completed
                            </option>

                        </select>

                    </div>


                    <!-- DUE DATE -->

                    <div>

                        <label for="due_date">
                            Due Date
                        </label>

                        <input
                            type="date"
                            id="due_date"
                            name="due_date"
                        >

                    </div>


                </div>


                <!-- ADD BUTTON -->

                <button
                    class="add-button"
                    type="submit"
                >
                    + Add Task
                </button>


            </form>

        </section>


        <!-- =========================
             TASK HEADER
        ========================= -->

        <div class="tasks-header">

            <h2>
                My Tasks
            </h2>

            <span class="task-count">

                {{ $totalTasks }}

                {{ $totalTasks == 1 ? 'Task' : 'Tasks' }}

            </span>

        </div>


        <!-- =========================
             TASK LIST
        ========================= -->

        @if ($tasks->count() > 0)


            <div class="task-grid">


                @foreach ($tasks as $task)


                    <div class="task-card">


                        <!-- TASK NAME -->

                        <h3>
                            {{ $task->task_name }}
                        </h3>


                        <!-- DESCRIPTION -->

                        <p class="description">

                            {{ $task->description ?: 'No description provided.' }}

                        </p>


                        <!-- STATUS -->

                        @if ($task->status == 'Completed')

                            <span class="status completed">
                                ✓ Completed
                            </span>

                        @else

                            <span class="status">
                                ⏳ Pending
                            </span>

                        @endif


                        <!-- DUE DATE -->

                        <p class="due-date">

                            📅

                            <strong>
                                Due:
                            </strong>

                            {{ $task->due_date ?? 'No due date' }}

                        </p>


                        <!-- =========================
                             ACTION BUTTONS
                        ========================= -->

                        <div class="actions">


                            <!-- EDIT BUTTON -->

                            <a
                                class="edit-button"
                                href="/tasks/{{ $task->id }}/edit"
                            >
                                ✏️ Edit
                            </a>


                            <!-- DELETE BUTTON -->

                            <form
                                action="/tasks/{{ $task->id }}"
                                method="POST"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    class="delete-button"
                                    type="submit"
                                    onclick="return confirm('Are you sure you want to delete this task?')"
                                >
                                    🗑️ Delete
                                </button>

                            </form>


                        </div>


                    </div>


                @endforeach


            </div>


        @else


            <!-- =========================
                 NO TASKS
            ========================= -->

            <div class="empty">

                <div class="empty-icon">
                    📝
                </div>

                <h3>
                    No tasks yet
                </h3>

                <p>
                    Add your first task using the form above.
                </p>

            </div>


        @endif


    </main>


    <!-- =========================
         FOOTER
    ========================= -->

    <footer class="footer">

        Personal Task Manager • Built with Laravel

    </footer>


</body>
</html>