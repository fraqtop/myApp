<?php

namespace App\Http\Controllers\Admin;

use App\Services\TaskService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    private $tasks;
    private $users;
    private $request;

    public function get()
    {
        return view('admin.tasks', ['tasks' => $this->tasks->getAll()]);
    }

    public function create()
    {
        $this->tasks->create($this->request);
        return redirect()->back();
    }

    public function delete()
    {
        $priority = $this->tasks->delete($this->request);
        $this->users->adjustKarma(\Auth::user(), $priority);
        return redirect()->back();
    }

    public function __construct(TaskService $taskService, UserService $userService, Request $request)
    {
        $this->tasks = $taskService;
        $this->users = $userService;
        $this->request = $request;
    }
}
