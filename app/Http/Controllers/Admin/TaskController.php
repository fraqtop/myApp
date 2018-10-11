<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

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

    public function delete(Request $request, $taskId)
    {
        $task = Task::find($taskId);
        if (!$request->post('is_done'))
        {
            $task->priority *= -1;
        }
        Auth::user()->karma += $task->priority;
        Auth::user()->save();
        $task->delete();
        return redirect()->back();
    }
}
