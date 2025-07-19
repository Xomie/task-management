<x-app-layout>
        <div class="max-w-full h-full mx-auto ">
            <div class="bg-white h-screen sm:px-6 lg:px-16 p-6">
                <div class="w-full flex justify-between items-end">
                    <div class="pl-2 border-blue-700 border-l-4">
                        <h2 class="font-bold text-3xl text-gray-800  leading-tight">
                                {{ __('Tasks') }}
                        </h2>
                        <p class="text-sm text-zinc-600 leading-tight">Manage your task and stay organized</p>
                    </div>
                    <a href="{{ route('task.create') }}" class="bg-indigo-500 flex shadow-md items-center gap-x-1 text-white px-3 py-2 rounded text-sm hover:bg-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        Add Task</a>
                </div>
                
                @if(session('success'))
                    <div 
                        x-data="{ show: true }" 
                        x-show="show" 
                        x-transition 
                        class="bg-green-100 text-green-700 p-3 mt-2 flex items-start justify-between gap-x-2 rounded mb-4"
                    >
                        <div class="flex items-center gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-list-icon lucide-clipboard-list">
                                <rect width="8" height="4" x="8" y="2" rx="1" ry="1"/>
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                                <path d="M12 11h4"/>
                                <path d="M12 16h4"/>
                                <path d="M8 11h.01"/>
                                <path d="M8 16h.01"/>
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>

                        <button @click="show = false" class="text-green-700 hover:text-green-900 font-bold text-lg leading-none">
                            &times;
                        </button>
                    </div>
                @endif


                {{-- Validation errors --}}
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

          
                {{-- Task Table --}}
                <div class="mt-5">               
                    <table class="w-full border border-gray-300 rounded-md text-sm">
                        <thead class="text-zinc-600">
                            <tr>
                                <th class="text-left p-2">Title</th>
                                <th class="text-left p-2">Description</th>
                                <th class="text-left p-2">Due Date</th>
                                <th class="text-left p-2">Status</th>
                                <th class="text-center p-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr class="border-t hover:bg-zinc-50">
                                    <td class="p-2">{{ $task->title }}</td>
                                    <td class="p-2">{{ $task->description }}</td>
                                    <td class="p-2">{{ $task->due_date }}</td>
                                    <td class="p-2 {{$task->is_completed ? "text-green-700" : "text-orange-400"}}">{{ $task->is_completed ? 'Completed' : 'Pending' }}</td>
                                    <td class="p-2">

                                        <div class="flex justify-center ">
                                            <form action="{{ route('task.toggle', $task->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button class="p-2 rounded text-sm hover:bg-zinc-200">
                                                    @if($task->is_completed)
                                                            Mark as Pending
                                                        @else
                                                            <div class="flex items-center gap-x-1">
                                                                {!! '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline lucide lucide-circle-check-big-icon"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>' !!}
                                                            Mark as Completed
                                                            </div>
                                                        @endif
                                                </button>
                                            </form>

                                            <a href="{{ route('task.edit', $task->id) }}" class="p-2 rounded text-sm hover:bg-zinc-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pen-line-icon lucide-pen-line"><path d="M12 20h9"/><path d="M16.376 3.622a1 1 0 0 1 3.002 3.002L7.368 18.635a2 2 0 0 1-.855.506l-2.872.838a.5.5 0 0 1-.62-.62l.838-2.872a2 2 0 0 1 .506-.854z"/></svg>
                                            </a>

                                            <form action="{{ route('task.destroy', $task->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button class=" p-2 rounded text-sm hover:bg-zinc-200"
                                                    onclick="return confirm('Are you sure?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash"><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                                </button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- CUstom Pagination --}}
                    <div class="mt-4">
                        {{ $tasks->links('vendor.pagination.custom-pagination') }}
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>
