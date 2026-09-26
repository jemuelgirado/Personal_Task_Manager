<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            opacity: .85;
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

        .container {
            max-width: 1100px;
            margin: -40px auto 50px;
            padding: 0 20px;
            position: relative;
        }

        .message {
            padding: 13px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .hidden {
            display: none;
        }

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
            box-shadow: 0 8px 25px rgba(15, 23, 42, .08);
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

        .form-card {
            background: white;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(15, 23, 42, .07);
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
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

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
        }

        .add-button:disabled {
            opacity: .6;
            cursor: not-allowed;
        }

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
            box-shadow: 0 6px 20px rgba(15, 23, 42, .06);
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

        .due-date {
            margin-top: 18px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            color: #64748b;
            font-size: 13px;
        }

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

        .delete-button {
            color: #dc2626;
            background: #fef2f2;
            border: 1px solid #fecaca;
        }

        .delete-button:disabled {
            opacity: .5;
        }

        .empty {
            background: white;
            border-radius: 16px;
            padding: 55px 20px;
            text-align: center;
            border: 1px dashed #cbd5e1;
            grid-column: 1 / -1;
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

        .footer {
            text-align: center;
            padding: 30px;
            color: #94a3b8;
            font-size: 13px;
        }

        @media (max-width: 700px) {
            .header h1 {
                font-size: 29px;
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
        }
    </style>
</head>

<body>

<header class="header">
    <div class="header-content">

        <div class="logo">
            ✦ TASK MANAGER
        </div>

        <h1>Personal Task Manager</h1>

        <p>
            Organize your tasks. Stay focused. Get things done.
        </p>

    </div>
</header>

<main class="container">

    <div id="message" class="message hidden"></div>

    <section class="stats">

        <div class="stat-card">
            <div class="stat-title">TOTAL TASKS</div>
            <div class="stat-number" id="totalTasks">
                {{ $tasks->count() }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-title">PENDING</div>
            <div class="stat-number" id="pendingTasks">
                {{ $tasks->where('status', 'Pending')->count() }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-title">COMPLETED</div>
            <div class="stat-number" id="completedTasks">
                {{ $tasks->where('status', 'Completed')->count() }}
            </div>
        </div>

    </section>

    <!-- ADD TASK -->

    <section class="form-card">

        <h2 class="form-title">
            Create a New Task
        </h2>

        <p class="form-subtitle">
            Add a task and keep track of your progress.
        </p>

        <form id="addTaskForm">

            @csrf

            <div class="form-grid">

                <div class="full">
                    <label>Task Name</label>

                    <input
                        type="text"
                        id="task_name"
                        name="task_name"
                        placeholder="e.g. Finish Laravel project"
                        required
                    >
                </div>

                <div class="full">
                    <label>Description</label>

                    <textarea
                        id="description"
                        name="description"
                        placeholder="Describe what you need to do..."
                    ></textarea>
                </div>

                <div>
                    <label>Status</label>

                    <select id="status" name="status" required>
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>

                <div>
                    <label>Due Date</label>

                    <input
                        type="date"
                        id="due_date"
                        name="due_date"
                    >
                </div>

            </div>

            <button
                type="submit"
                class="add-button"
                id="addButton"
            >
                + Add Task
            </button>

        </form>

    </section>

    <div class="tasks-header">

        <h2>My Tasks</h2>

        <span class="task-count" id="taskCount">
            {{ $tasks->count() }}
            {{ $tasks->count() == 1 ? 'Task' : 'Tasks' }}
        </span>

    </div>

    <div class="task-grid" id="taskGrid">

        @forelse($tasks as $task)

            <div class="task-card" id="task-{{ $task->id }}">

                <h3>
                    {{ $task->task_name }}
                </h3>

                <p class="description">
                    {{ $task->description ?: 'No description provided.' }}
                </p>

                @if($task->status === 'Completed')

                    <span class="status completed">
                        ✓ Completed
                    </span>

                @else

                    <span class="status">
                        ◷ Pending
                    </span>

                @endif

                <p class="due-date">
                    📅
                    <strong>Due:</strong>
                    {{ $task->due_date ?? 'No due date' }}
                </p>

                <div class="actions">

                    <a
                        href="{{ route('tasks.edit', $task->id) }}"
                        class="edit-button"
                    >
                        ✎ Edit
                    </a>

                    <button
                        type="button"
                        class="delete-button"
                        onclick="deleteTask({{ $task->id }})"
                    >
                        🗑 Delete
                    </button>

                </div>

            </div>

        @empty

            <div class="empty" id="emptyMessage">

                <div class="empty-icon">📝</div>

                <h3>No tasks yet</h3>

                <p>
                    Create your first task using the form above.
                </p>

            </div>

        @endforelse

    </div>

</main>

<footer class="footer">
    Personal Task Manager • Laravel Project
</footer>


<script>

    // CSRF TOKEN
    const csrfToken =
        document.querySelector('meta[name="csrf-token"]').getAttribute('content');


    // MESSAGE
    function showMessage(message, type = 'success') {

        const box = document.getElementById('message');

        box.textContent = message;

        box.className = 'message ' + type;

        setTimeout(() => {
            box.className = 'message hidden';
        }, 3000);
    }


    // UPDATE STATISTICS
    function updateStatistics() {

        const cards =
            document.querySelectorAll('.task-card');

        let pending = 0;
        let completed = 0;

        cards.forEach(card => {

            const status =
                card.querySelector('.status');

            if (status) {

                if (status.textContent.includes('Completed')) {
                    completed++;
                } else {
                    pending++;
                }

            }

        });

        const total = cards.length;

        document.getElementById('totalTasks').textContent = total;

        document.getElementById('pendingTasks').textContent = pending;

        document.getElementById('completedTasks').textContent = completed;

        document.getElementById('taskCount').textContent =
            total + (total === 1 ? ' Task' : ' Tasks');

    }


    // ADD TASK USING FETCH
    document
        .getElementById('addTaskForm')
        .addEventListener('submit', async function(event) {

            event.preventDefault();

            const button =
                document.getElementById('addButton');

            button.disabled = true;

            button.textContent = 'Adding...';

            const formData =
                new FormData(this);

            try {

                const response = await fetch('/tasks', {

                    method: 'POST',

                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
                    },

                    body: formData
                });


                const data = await response.json();


                if (!response.ok) {

                    if (data.errors) {

                        throw new Error(
                            Object.values(data.errors)
                                .flat()
                                .join(', ')
                        );

                    }

                    throw new Error(
                        data.message || 'Failed to add task.'
                    );
                }


                const task = data.task;


                const empty =
                    document.getElementById('emptyMessage');

                if (empty) {
                    empty.remove();
                }


                const taskCard =
                    document.createElement('div');

                taskCard.className = 'task-card';

                taskCard.id = 'task-' + task.id;


                const statusHTML =
                    task.status === 'Completed'
                        ? '<span class="status completed">✓ Completed</span>'
                        : '<span class="status">◷ Pending</span>';


                taskCard.innerHTML = `

                    <h3>${escapeHTML(task.task_name)}</h3>

                    <p class="description">
                        ${escapeHTML(task.description || 'No description provided.')}
                    </p>

                    ${statusHTML}

                    <p class="due-date">
                        📅
                        <strong>Due:</strong>
                        ${task.due_date || 'No due date'}
                    </p>

                    <div class="actions">

                        <a
                            href="/tasks/${task.id}/edit"
                            class="edit-button"
                        >
                            ✎ Edit
                        </a>

                        <button
                            type="button"
                            class="delete-button"
                            onclick="deleteTask(${task.id})"
                        >
                            🗑 Delete
                        </button>

                    </div>
                `;


                document
                    .getElementById('taskGrid')
                    .prepend(taskCard);


                this.reset();

                updateStatistics();

                showMessage('✓ Task added successfully!');


            } catch (error) {

                console.error(error);

                showMessage(
                    'Error: ' + error.message,
                    'error'
                );

            } finally {

                button.disabled = false;

                button.textContent = '+ Add Task';

            }

        });


    // DELETE TASK USING FETCH
    async function deleteTask(id) {

        if (!confirm('Are you sure you want to delete this task?')) {
            return;
        }


        const card =
            document.getElementById('task-' + id);


        try {

            const response = await fetch(
                '/tasks/' + id,
                {
                    method: 'DELETE',

                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
                    }
                }
            );


            const data =
                await response.json();


            if (!response.ok) {

                throw new Error(
                    data.message || 'Failed to delete task.'
                );

            }


            card.remove();

            updateStatistics();

            showMessage('✓ Task deleted successfully!');


            const cards =
                document.querySelectorAll('.task-card');


            if (cards.length === 0) {

                document.getElementById('taskGrid').innerHTML = `

                    <div class="empty" id="emptyMessage">

                        <div class="empty-icon">📝</div>

                        <h3>No tasks yet</h3>

                        <p>
                            Create your first task using the form above.
                        </p>

                    </div>

                `;

            }


        } catch (error) {

            console.error(error);

            showMessage(
                'Error: ' + error.message,
                'error'
            );

        }

    }


    // ESCAPE HTML
    function escapeHTML(value) {

        const div =
            document.createElement('div');

        div.textContent = value;

        return div.innerHTML;

    }

</script>

</body>
</html>