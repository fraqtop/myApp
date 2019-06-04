@extends('layouts.admin')
@section('content')
    <script>
        let countsArray = [];
    </script>
    @foreach($tasks as $task)
        <div class="task-container">
            <h2>{{ $task->title }}</h2>
            <div class="countdown-container">
                <div class="dial">
                    <span>days</span>
                    <p id="days{{$task->id}}"></p>
                </div>
                <div class="dial">
                    <span>hours</span>
                    <p id="hours{{$task->id}}"></p>
                </div>
                <div class="dial">
                    <span>minutes</span>
                    <p id="minutes{{$task->id}}"></p>
                </div>
                <div class="dial">
                    <span>seconds</span>
                    <p id="seconds{{$task->id}}"></p>
                </div>
            </div>
                <script>
                    let timer{{$task->id}} = setInterval(function () {
                        countdown({{ $task->id }}, "{{ $task->deadline }}");
                    }, 1000);
                    countsArray.push(timer);
                </script>
                <form method="post" action="/admin/tasks/{{$task->id}}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <input type="checkbox" name="is_done">
                    <label style="margin-right: 15px">done</label>
                    <input type="submit" class="btn btn-danger" value="delete">
                </form>
        </div>
    @endforeach
    <form class="admin-form" method="post" action="/admin/tasks/create">
        {{csrf_field()}}
        <div class="form-group">
            <input class="form-control" placeholder="Task name" name="taskTitle" required>
        </div>
        <div class="form-group">
            <label>Task deadline</label>
            <input class="form-control" type="datetime-local" name="taskDeadline" required>
        </div>
        <div class="form-group">
            <label>Task priority</label>
            <select class="form-control" name="taskPriority">
                <option value="1">Low</option>
                <option value="2">Normal</option>
                <option value="3">Desirable</option>
                <option value="4">Necessary</option>
            </select>
        </div>
        <div class="form-group">
            <span class="alert-danger">{{$errors->first()}}</span>
        </div>
        <input type="submit" class="btn btn-dark" value="add">

    </form>
@endsection
@section('script')
    <script>
        function countdown(id, deadline) {
            let now = (new Date()).getTime();
            deadline = (new Date(`${deadline}`)).getTime();
            let distance = deadline - now;
            let days = Math.floor(distance / (1000 * 60 * 60 * 24));
            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById(`days${id}`).innerHTML = `${days}`;
            document.getElementById(`hours${id}`).innerHTML = `${hours}`;
            document.getElementById(`minutes${id}`).innerHTML = `${minutes}`;
            document.getElementById(`seconds${id}`).innerHTML = `${seconds}`;
        }
    </script>
@endsection