<?php

namespace Tests\Feature;

use App\Models\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TaskDeletingTest extends TestCase
{
    use DatabaseTransactions;

    private $oldKarma;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::find(1);
        $this->be($user);
        $this->oldKarma = $user->karma;
    }

    public function testIsDoneDeleting()
    {
        $task = factory(Task::class)->create();
        $this->delete("/admin/tasks/$task->id", [
            '_token' => csrf_token(),
            'is_done' => 'on'
        ]);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
        $this->assertEquals(User::find(1)->karma, $this->oldKarma + $task->priority);
    }

    public function testIsNotDoneDeleted()
    {
        $task = factory(Task::class)->create();
        $this->delete("/admin/tasks/$task->id", [
            '_token' => csrf_token()
        ]);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
        $this->assertEquals(User::find(1)->karma, $this->oldKarma - $task->priority);
    }
}
