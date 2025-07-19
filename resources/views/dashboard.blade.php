<?php
    $cards = [
        ['title' => 'Pending Task', 'count' =>  $pendingCount, 'text' => 'text-yellow-800', 'description' => 'Total count of tasks not yet completed.'],
        ['title' => 'Completed Task', 'count' => $completedCount, 'text' => 'text-green-800', 'description' => 'Total number of tasks finished.'],
    ];
    ?>
<x-app-layout>
    <div class="h-screen bg-white sm:px-6 lg:px-16 p-6">
        <h1 class="text-3xl font-bold text-zinc-700">Dashboard</h1>
        <div class="grid grid-cols-2 gap-3 mt-3">
            @foreach ($cards as $card)
                <div class="h-44 border hover:shadow-md rounded-md p-6 hover:scale-95 {{ $card['text'] }} transition-transform">
                    <h1 class="text-xl font-medium">{{ $card['title']}}</h1>
                    <b class="text-6xl">{{$card['count']}}</b>
                    <p class="text-sm text-zinc-500 mt-4">{{ $card['description'] }}</p>
                </div>
            @endforeach
        </div>

        <h1 class="mt-2 mb-2 font-medium text-lg">Recently Added Tasks</h1>
         <table class="w-full border border-gray-300 rounded-md text-sm">
                        <thead class="text-zinc-600">
                            <tr>
                                <th class="text-left p-2">Title</th>
                                <th class="text-left p-2">Description</th>
                                <th class="text-left p-2">Due Date</th>
                                <th class="text-left p-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTask as $task)
                                <tr class="border-t">
                                    <td class="p-2">{{ $task->title }}</td>
                                    <td class="p-2">{{ $task->description }}</td>
                                    <td class="p-2">{{ $task->due_date }}</td>
                                    <td class="p-2 {{$task->is_completed ? "text-green-700" : "text-orange-400"}}">{{ $task->is_completed ? 'Completed' : 'Pending' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

    </div>
</x-app-layout>
