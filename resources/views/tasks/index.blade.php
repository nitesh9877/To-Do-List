<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">To-Do List App</h1>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Error Message -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Input Form -->
        <div class="row justify-content-center">
            <div class="col-md-6"> <!-- Adjust the width by changing col-md-* -->
                <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="task" class="form-control" placeholder="Enter Task" required>
                        <button type="submit" class="btn btn-primary ms-2">Add Task</button> <!-- Add margin with ms-2 -->
                    </div>
                </form>
            </div>
        </div>

        <!-- Task List -->
        <div class="row justify-content-center"> <!-- Centering the table -->
            <div class="col-md-8"> <!-- Adjust table width by changing col-md-* -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $index => $task)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $task->task }}</td>
                                <td>{{ $task->is_completed ? 'Done' : 'Pending' }}</td>
                                <td>
                                    <!-- Update Task (Toggle Complete) -->
                                    @if (!$task->is_completed)
                                        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success">✔</button>
                                        </form>
                                    @endif

                                    <!-- Delete Task -->
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are u sure to delete this task ?')">❌</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
