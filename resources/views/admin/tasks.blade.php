@extends('layouts.admin')
@section('content')
    @foreach($tasks as $task)
        <div class="task">
            <h2>{{ $task->title }}</h2>
            <h3>
                {{
                    (new DateTime('now', new DateTimeZone('Europe/Moscow')))
                    ->diff(new Datetime($task->deadline))->format('%a : %H : %i : %s')
                }}
            </h3>
            <form method="post" action="/admin/tasks/{{$task->id}}">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <input type="submit" class="form-control btn btn-danger" value="delete">
            </form>
        </div>
    @endforeach
    <form class="admin-form" method="post" action="/admin/tasks/create">
        {{csrf_field()}}
        <div class="form-group">
            <input class="form-control" placeholder="Task name" name="taskTitle">
        </div>
        <div class="form-group">
            <label>Task deadline</label>
            <input class="form-control" type="datetime-local" name="taskDeadline">
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
        <input type="submit" class="btn btn-dark" value="add">
    </form>
@endsection