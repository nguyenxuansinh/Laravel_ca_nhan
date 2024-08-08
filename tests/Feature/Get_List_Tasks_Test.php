<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class Get_List_Tasks_Test extends TestCase
{
    use RefreshDatabase;


    private function response_get_list()
    {
        $response = $this->get(route('index'));
        $response->assertStatus(200);
        $response->assertViewIs('index');
        $response->assertViewHas('tasks');
        
        return $response;
    }


    #[Test]
    public function get_list_task_no_login_if_has_data(): void
    {
        Task::factory()->count(20)->create();
        $this->assertDatabaseCount('tasks', 20);
        $response = $this->response_get_list();
        $tasks = Task::paginate(10);
        $this->assertFalse($tasks->isEmpty());
        foreach ($tasks as $task) {
            $response->assertSee($task->name);
            $response->assertSee($task->content);
            $response->assertSee($task->status);
        }
    }

    #[Test]
    public function get_list_task_no_login_if_not_has_data(): void
    {
        $this->assertDatabaseCount('tasks', 0);
        $response = $this->response_get_list();
        $tasks = $response->viewData('tasks');
        $this->assertTrue($tasks->isEmpty());
        $response->assertSee('No tasks found');
    }
}
