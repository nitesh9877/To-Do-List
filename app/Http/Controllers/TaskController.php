<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //============ Show all tasks ====================
    public function index()
    {
        $tasks = Task::all();
        // return view('welcome', compact('tasks')); 
        return view('tasks.index', compact('tasks'));
    }

    //=============== Store a new task ===================
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|unique:tasks,task',
        ]);

        Task::create([
            'task' => $request->task,
        ]);

        return redirect()->back()->with('success', 'Task added successfully!');
    }

    //============== Update task (toggle completion) ==========================
    public function update($id)
    {
        $task = Task::findOrFail($id);
        $task->is_completed = !$task->is_completed;
        $task->save();

        return redirect()->back()->with('success', 'Task updated successfully!');
    }

    //==================== Delete a task =======================================
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully!');
    }
}
