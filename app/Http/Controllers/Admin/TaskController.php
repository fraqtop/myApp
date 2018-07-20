<?php

namespace App\Http\Controllers\Admin;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function get()
    {
        return view('admin.tasks', ['tasks' => Task::orderBy('deadline')->get()]);
    }

    public function create(Request $request)
    {
        Task::create([
            'title' => $request->post('taskTitle'),
            'deadline' => $request->post('taskDeadline'),
            'priority' => $request->post('taskPriority')
        ]);
        return redirect()->back();
    }
    public function delete($taskId)
    {
        $task = Task::find($taskId);
        $task->delete();
        return redirect()->back();
    }
}
