<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="{{ asset('css/edit.css') }}" rel="stylesheet">
    <title>Edit Task</title>
    <style>

    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Task</h2>
        <form method="POST" action="{{ route('update', ['id' => $task->task_id]) }}">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}"
                    required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required>{{ $task->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    @foreach (['Pending', 'In Progress', 'Completed'] as $option)
                        <option value="{{ $option }}" {{ $task->status == $option ? 'selected' : '' }}>
                            {{ $option }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Update Task</button>
        </form>
    </div>
</body>

</html>
