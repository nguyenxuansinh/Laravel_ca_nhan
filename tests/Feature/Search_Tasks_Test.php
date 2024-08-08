<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class Search_Tasks_Test extends TestCase
{
    use RefreshDatabase;

    private function createTasks()
    {
        $task1 = Task::factory()->create([
            'name' => 'sinh',
            'content' => 'zys',
            'status' => 'chưa hoàn thành',
        ]);

        $task2 = Task::factory()->create([
            'name' => 'xuan',
            'content' => 'asd',
            'status' => 'đã hoàn thành',
        ]);

        return [$task1, $task2];
    }
    private function status_and_response($response)
    {
        $response->assertStatus(200);
        $response->assertJsonStructure(['content']);
    }
    #[Test]
    public function not_has_data_and_search(): void
    {
       
        $response = $this->getJson(route('tasks.search', [
            'search' => '',
            'selectedValue' => ''
        ]));
        $this->status_and_response($response);
        $this->assertStringContainsString('No tasks found', $response->json('content'));
    }
    #[Test]
    public function has_data_and_search_for_tasks_with_two_valid_conditions(): void
    {
        [$task1, $task2] = $this->createTasks();
        $response = $this->getJson(route('tasks.search', [
            'search' => 'sinh',
            'selectedValue' => 'chưa hoàn thành'
        ]));
        $this->status_and_response($response);
        $this->assertStringContainsString($task1->name, $response->json('content'));
        $this->assertStringContainsString($task1->content, $response->json('content'));
        $this->assertStringNotContainsString($task2->name, $response->json('content'));
        $this->assertStringNotContainsString($task2->content, $response->json('content'));
    }

    #[Test]
    public function has_data_and_search_for_tasks_with_not_valid_conditions(): void
    {
        [$task1, $task2] = $this->createTasks();
        $response = $this->getJson(route('tasks.search', [
            'search' => 'nguyen',
            'selectedValue' => 'xong'
        ]));
        $this->status_and_response($response);
        $this->assertStringContainsString('No tasks found', $response->json('content'));
    }

   
    #[Test]
    public function has_data_and_search_task_with_if_input_search_null(): void
    {
        [$task1, $task2] = $this->createTasks();
        $response = $this->getJson(route('tasks.search', [
            'search' => '',
            'selectedValue' => 'chưa hoàn thành'
        ]));
    
        $this->status_and_response($response);
        $this->assertStringContainsString($task1->name, $response->json('content'));
        $this->assertStringContainsString($task1->content, $response->json('content'));
        $this->assertStringNotContainsString($task2->name, $response->json('content'));
        $this->assertStringNotContainsString($task2->content, $response->json('content'));
    }
    #[Test]
    public function has_data_and_search_task_with_if_selectedValue_null(): void
    {
        [$task1, $task2] = $this->createTasks();
        $response = $this->getJson(route('tasks.search', [
            'search' => 'sinh',
            'selectedValue' => ''
        ]));
    
        $this->status_and_response($response);
        $this->assertStringContainsString($task1->name, $response->json('content'));
        $this->assertStringContainsString($task1->content, $response->json('content'));
        $this->assertStringNotContainsString($task2->name, $response->json('content'));
        $this->assertStringNotContainsString($task2->content, $response->json('content'));
    }

    #[Test]
    public function has_data_and_search_task_if_selectedValue_null_and_input_search_null(): void
    {
        [$task1, $task2] = $this->createTasks();
        $response = $this->getJson(route('tasks.search', [
            'search' => '',
            'selectedValue' => ''
        ]));
        $this->status_and_response($response);
        $this->assertStringContainsString($task1->name, $response->json('content'));
        $this->assertStringContainsString($task1->content, $response->json('content'));
        $this->assertStringContainsString($task2->name, $response->json('content'));
        $this->assertStringContainsString($task2->content, $response->json('content'));
    }
}
