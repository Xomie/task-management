<x-app-layout>
    {{-- reusable form for editing task --}}
        <div class="h-screen sm:px-6 lg:px-16 p-6 bg-white">
            <h1 class="text-3xl  font-bold text-zinc-600">Edit Task: <b class="text-blue-700">{{ $task->title }}</b></h1>
            @include('tasks._form', [
                'action' => route('task.update', $task->id),
                'method' => 'PUT',
                'buttonText' => 'Update Task',
                'task' => $task
            ])
            
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4 mt-2">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
</x-app-layout>
