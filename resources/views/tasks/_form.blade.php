<form action="{{ $action }}" method="POST" class="space-y-4">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div>
        <label for="title" class="block font-medium">Title <span class="text-red-500">*</span></label>
        <x-text-input type="text" name="title" id="title" value="{{ old('title', $task->title ?? '') }}"
               class="w-full"/>
    </div>

    <div>
        <label for="description" class="block font-medium">Description</label>
        <textarea name="description" id="description"
                  class="w-full border border-gray-300 rounded p-2 h-24 focus:outline-none focus:ring focus:border-blue-400">{{ old('description', $task->description ?? '') }}</textarea>
    </div>

    <div>
        <label for="due_date" class="block font-medium">Due Date</label>
        <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date ?? '') }}"
               class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-400">
    </div>

    <div class="flex items-center gap-2 justify-end">
        <a href="{{ route('task.index') }}"
           class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 text-sm rounded">
            Cancel
        </a>
        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 text-sm rounded">
            {{ $buttonText }}
        </button>
        
    </div>
</form>
