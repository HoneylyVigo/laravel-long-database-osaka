@foreach ($tasks as $task)
    <div class="task">
        <h4>{{ $task->title }}</h4>
        <p>{{ $task->description }}</p>
        <p>Status: {{ $task->status }}</p>
        <p>Created by: {{ $task->username }}</p>
    </div>
@endforeach

@if (count($tasks) === 0)
    <p>No tasks found for this category.</p>
@endif