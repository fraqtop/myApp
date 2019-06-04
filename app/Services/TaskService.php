<?php


namespace App\Services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Models\Task;

class TaskService implements Service
{
    public function create(Request $request): Model
    {
        $request->validate([
            'taskTitle' => 'required|max:250',
            'taskDeadline' => [
                'required',
                function($attribute, $value, $fail){
                    Carbon::createFromTimeString($value);
                    if ($value < Carbon::now()) {
                        $fail('deadline can\'t be in past');
                    }
                }
            ],
            'taskPriority' => 'required',
        ]);

        $task = Task::create([
            'title' => $request->post('taskTitle'),
            'deadline' => $request->post('taskDeadline'),
            'priority' => $request->post('taskPriority')
        ]);
        return $task;
    }

    public function get(int $id): Model
    {
        return Task::find($id);
    }

    public function getAll(): Collection
    {
        return Task::orderBy('deadline')->get();
    }

    public function update(int $id, array $data)
    {
        return Task::find($id)->update($data);
    }

    public function delete(Request $request)
    {
        $task = Task::find($request->route('task_id'));
        $priority = $task->priority;
        if (!$request->has('is_done')) {
            $priority *= -1;
        }
        $task->delete();
        return $priority;
    }

}