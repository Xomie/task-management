<?php

namespace App\Http\Controllers;

use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $recentTask = Task::where('user_id', auth()->id())->latest()->take(5)->get();

        $completedCount = Task::where('user_id', auth()->id())->where('is_completed', true)->count();

        $pendingCount = Task::where('user_id', auth()->id())->where('is_completed', false)->count();

        return view('dashboard', compact('recentTask', 'completedCount', 'pendingCount'));
    }
}
