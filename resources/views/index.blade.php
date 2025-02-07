<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">To-Do List</h1>

        <form action="{{ route('task.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="task" class="form-label">New Task:</label>
                <input type="text" class="form-control" id="task" name="task" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>

        <div class="mt-4">
            <h3>Tasks</h3>
            <ul class="list-group">
                @if(count($tasks) > 0)
                    @foreach($tasks as $index => $task)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $task }}
                            <form action="{{ route('task.delete', $index) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </li>
                    @endforeach
                @else
                    <li class="list-group-item text-center">No tasks found.</li>
                @endif
            </ul>
            <form action="{{ route('task.clear') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-warning">Clear All</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
