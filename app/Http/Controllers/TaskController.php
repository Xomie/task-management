<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())
                     ->orderBy('created_at', 'desc')
                     ->paginate(5);

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('task.index')->with('success', 'Task added!');
    }

    public function edit(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->only(['title', 'description', 'due_date']));

        return redirect()->route('task.index')->with('success', 'Task updated!');
    }

    public function destroy(Task $task)
    {
        $this->authorizeTask($task);

        $task->delete();

        return redirect()->route('task.index')->with('success', 'Task deleted!');
    }

    public function toggle(Task $task)
    {
        $this->authorizeTask($task);
        $task->is_completed = !$task->is_completed;
        $task->save();

        return redirect()->route('task.index');
    }


    private function authorizeTask(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }
    }
}
