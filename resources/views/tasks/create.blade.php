
<x-app-layout>
    {{-- reusable form for creating new task --}}
    <div class="h-screen sm:px-6 lg:px-16 p-6 bg-white">
        <h1 class="text-3xl  font-bold text-zinc-600">Add New Task</h1>
        @include('tasks._form', [
        'action' => route('task.store'),
        'method' => 'POST',
        'buttonText' => 'Save Task',
        'task' => null
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

