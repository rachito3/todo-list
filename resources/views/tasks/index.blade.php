<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h1 class="mb-4">Todo List</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add Task Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Task Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </form>
            </div>
        </div>

        <!-- Tasks List -->
        <div class="list-group">
            @foreach($tasks as $task)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <form action="{{ route('tasks.update', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <input type="checkbox" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                            <span class="{{ $task->completed ? 'text-decoration-line-through' : '' }}">
                                {{ $task->title }}
                            </span>
                        </form>
                    </div>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>