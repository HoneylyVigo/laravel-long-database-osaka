<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <title>Home</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#"><i class="fas fa-list"></i> Todo List App</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('add') }}"><i class="fas fa-plus"></i> Add Tasks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories') }}"><i class="fas fa-tags"></i>
                                Categories</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar-nav">
                    <a class="nav-link" href="{{ route('profile') }}"><i class="fas fa-user"></i> Profile</a>
                    <a class="nav-link" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-task">
        <h2>Task List</h2>
        @php
            $userID = session('user_id');
            $tasks = DB::table('Tasks')
                ->where('user_id', $userID)
                ->get();
        @endphp

        @if ($tasks->count() > 0)
            @foreach ($tasks as $task)
                <div class="task">
                    <h4>{{ $task->title }}</h4>
                    <p class="com">{{ $task->description }}</p>
                    <p class="com">Status: {{ $task->status }}</p>

                    @php
                        $comments = DB::table('comments')
                            ->where('task_id', $task->task_id)
                            ->get();
                    @endphp

                    @if ($comments->count() > 0)
                        <h5>Comments:</h5>
                        @foreach ($comments as $comment)
                            <p>{{ $comment->comment_text }}</p>
                        @endforeach
                    @else
                        <p>No comments yet.</p>
                    @endif

                    <form method="POST" action="{{ route('add_comment') }}">
                        @csrf
                        <input type="hidden" name="task_id" value="{{ $task->task_id }}">
                        <textarea class="form-control" name="comment_text" placeholder="Add a comment" required></textarea>
                        <button type="submit" class="btn">Add Comment</button>
                    </form>

                    <a href="{{ route('edit', ['id' => $task->task_id]) }}" class="btn">Edit</a>
                    <a href="{{ route('delete', ['id' => $task->task_id]) }}" class="btn">Delete</a>
                </div>
            @endforeach
        @else
            <p>No tasks found.</p>
        @endif
    </div>
</body>

</html>
