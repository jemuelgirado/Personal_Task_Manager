<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

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

        .container {
            max-width: 700px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(15, 23, 42, .08);
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

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
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
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

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
        }

        .update-button {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            border: none;
            flex: 1;
        }

        .update-button:disabled {
            opacity: .6;
            cursor: not-allowed;
        }

        .cancel-button {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
            text-align: center;
        }

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

<div class="header">

    <div class="header-content">

        <h1>✏️ Edit Task</h1>

        <p>
            Update your task information and keep your work organized.
        </p>

    </div>

</div>


<div class="container">

    <div class="card">

        <h2>Update Task</h2>

        <p class="card-description">
            Change the details of your task below.
        </p>


        <div
            id="message"
            class="message hidden"
        ></div>


        <form id="editTaskForm">

            @csrf

            <div class="form-group">

                <label for="task_name">
                    Task Name
                </label>

                <input
                    type="text"
                    id="task_name"
                    name="task_name"
                    value="{{ $task->task_name }}"
                    required
                >

            </div>


            <div class="form-group">

                <label for="description">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                >{{ $task->description }}</textarea>

            </div>


            <div class="form-group">

                <label for="status">
                    Status
                </label>

                <select
                    id="status"
                    name="status"
                    required
                >

                    <option
                        value="Pending"
                        {{ $task->status === 'Pending' ? 'selected' : '' }}
                    >
                        Pending
                    </option>

                    <option
                        value="Completed"
                        {{ $task->status === 'Completed' ? 'selected' : '' }}
                    >
                        Completed
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label for="due_date">
                    Due Date
                </label>

                <input
                    type="date"
                    id="due_date"
                    name="due_date"
                    value="{{ $task->due_date }}"
                >

            </div>


            <div class="buttons">

                <button
                    type="submit"
                    class="update-button"
                    id="updateButton"
                >
                    ✓ Update Task
                </button>

                <a
                    href="{{ route('tasks.index') }}"
                    class="cancel-button"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>


<script>

    const form =
        document.getElementById('editTaskForm');

    const button =
        document.getElementById('updateButton');

    const message =
        document.getElementById('message');

    const csrfToken =
        document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content');


    function showMessage(text, type) {

        message.textContent = text;

        message.className =
            'message ' + type;

    }


    form.addEventListener('submit', async function(event) {

        event.preventDefault();


        button.disabled = true;

        button.textContent = 'Updating...';


        const formData =
            new FormData(form);


        try {

            const response = await fetch(
                '/tasks/{{ $task->id }}',
                {

                    method: 'POST',

                    headers: {

                        'Accept': 'application/json',

                        'X-Requested-With':
                            'XMLHttpRequest',

                        'X-CSRF-TOKEN':
                            csrfToken

                    },

                    body: (() => {

                        formData.append('_method', 'PUT');

                        return formData;

                    })()

                }
            );


            const data =
                await response.json();


            if (!response.ok) {

                if (data.errors) {

                    throw new Error(
                        Object.values(data.errors)
                            .flat()
                            .join(', ')
                    );

                }

                throw new Error(
                    data.message ||
                    'Failed to update task.'
                );

            }


            showMessage(
                '✓ Task updated successfully!',
                'success'
            );


            /*
             * Go back to the task list after
             * Laravel successfully updates it.
             */

            setTimeout(function() {

                window.location.href = '/';

            }, 500);


        } catch (error) {

            console.error(
                'Update error:',
                error
            );

            showMessage(
                'Error: ' + error.message,
                'error'
            );

            button.disabled = false;

            button.textContent = '✓ Update Task';

        }

    });

</script>

</body>
</html>