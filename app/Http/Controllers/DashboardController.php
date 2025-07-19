<?php

namespace App\Http\Controllers;

use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $recentTask = Task::latest()->take(5)->get();

        $completedCount = Task::where('is_completed', true)->count();
        $pendingCount = Task::where('is_completed', false)->count();

        return view('dashboard', compact('recentTask', 'completedCount', 'pendingCount'));
    }
}
