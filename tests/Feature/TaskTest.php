<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\{DatabaseTransactions, WithoutMiddleware};

class TaskTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;
    private $defaultTitle = 'test title';
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreatingValid()
    {
        $this->post('/admin/tasks/create', [
            'taskTitle' => $this->defaultTitle,
            'taskDeadline' => Carbon::now()->addDay(),
            'taskPriority' => rand(1, 5),
            ]);
        $this->assertDatabaseHas('tasks', ['title' => $this->defaultTitle]);
    }

    public function testCreatingOutdated()
    {
        $response = $this->post('/admin/tasks/create', [
            'taskTitle' => $this->defaultTitle,
            'taskDeadline' => Carbon::now()->subDay(),
            'taskPriority' => rand(1, 5)
        ]);
        $response->assertSessionHasErrors(['taskDeadline']);
    }

    public function testCreatingWithoutRequiredAttribute()
    {
        $response = $this->post('/admin/tasks/create', [
            'taskDeadline' => Carbon::now()->subDay(),
            'taskPriority' => rand(1, 5)
        ]);
        $response->assertSessionHasErrors(['taskTitle']);
    }
}
