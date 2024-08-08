<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $task;
    public function __construct(Task $task)
    {
        $this->task = $task;
    }
    public function index(Request $request)
    {
        $tasks = $this->task->search_and_list();
        if ($request->ajax()) {
            return response()->json([
                'content' => view('tasks.list_tasks', compact('tasks'))->render(),

            ]);
        }
        return view("index",compact("tasks"));
    }
    public function search(Request $request){   
        $key_search = [
            'searchTerm' => $request->input('search'),
            'selectedValue' => $request->input('selectedValue'),
        ];

        $tasks = $this->task->search_and_list2($key_search);

        //$tasks = $this->task->search_and_list($searchTerm, $selectedValue);
        
        return response()->json([
           'content' => view('tasks.list_tasks', compact('tasks'))->render()
            ]);
        
    }
}
