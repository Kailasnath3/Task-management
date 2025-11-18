<x-app-layout>
    <h2 class="text-xl mb-4 text-white">Create Task</h2>


    @if ($errors->any())
        <div class="bg-red-600 text-white p-3 rounded mb-4">


            <ul class="list-discn list-inside">
                @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 class="text-white" >Add a Task to Continue !</h1>

    <form method="POST" action="{{ route('tasks.store') }}">

        @csrf

        <label class="text-white">   Title</label>
        <input type="text" name="title"
               value="{{ old('title') }}"
               class="border p-2 w-full text-white bg-gray-800" required>

        <label class="text-white mt-3 block">Description</label>
        <textarea name="description" class="border p-2 w-full text-white bg-gray-800">{{ old('description') }}</textarea>

        <button class="bg-green-600 text-white px-4 py-2 rounded mt-3 hover:bg-green-700">
            Save
        </button>
    </form>
</x-app-layout>
