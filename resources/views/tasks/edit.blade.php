<x-app-layout>
    <h2 class="text-xl mb-4 text-white">Edit Task</h2>

    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
        @csrf 

        @method('PUT')

        <label class="text-white">Title</label>

        <input type="text" name="title" class="border p-2 w-full bg-gray-800 text-white"
               value="{{ $task->title }}" required>

        <label class="text-white mt-2 block">Description</label>

        <textarea name="description" class="border p-2 w-full bg-gray-800 text-white">
{{ $task->description }}

        </textarea>

        <label class="text-white mt-2 block">Status</label>

        <select name="status" class="border p-2 w-full bg-gray-800 text-white">
            <option value="pending" {{$task->status=='pending' ?'selected': '' }}>Pending</option>
            <option value="in-progress" {{ $task->status=='in-progress' ? 'selected' : '' }}>   In Progress</option>
            <option value="completed" {{ $task->status=='completed' ?'selected' :'' }}>Completed</option>
        </select>

        <button class="mt-3 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>
</x-app-layout>
