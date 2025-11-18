<x-app-layout>
 
    <div class="flex justify-between items-center   mb-6">

        <h2 class="text-2xl text-white">My Tasks</h2>

        <a href="{{ route('tasks.create') }}" 

           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
     Create Task
        </a>
    </div>

 
    <div class="mb-4">
        <input type="text" id="searchBox" placeholder="Search by title" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600">
    </div>

  
    <div class="overflow-x-auto">
        <table class="min-w-[1200px] w-full bg-gray-900 text-white border border-gray-700">
            <thead>
                <tr class="border-b border-gray-600">
                    <th class="p-3 text-left">Title</th>

                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Created</th>

                    <th class="p-3 text-left">Actions</th>

                </tr>
            </thead>
            <tbody id="taskTable">
                @forelse ($tasks as $task)




                    <tr class="border-b border-gray-700">
                        <td class="p-3">{{ $task->title }}</td>

                        <td class="p-3">
                            <select class="statusDropdown p-1 rounded text-white border border-gray-600"
                                    data-id="{{ $task->id }}">
                                <option value="pending" 
                                        style="background-color: #facc15;    color: black;" 
                                        @if($task->status == 'pending') selected @endif>
                                     Pending
                                </option>
                                <option value="in-progress" 
                                        style="   background-color: #3b82f6; color: white;" 
                                        @if($task->status == 'in-progress') selected @endif>
                                     In Progress
                                </option>
                                <option value="completed" 
                                        style="background-color: #16a34a; color: white;" 
                                        @if($task->status ==    'completed')selected @endif>
                                     Completed
                                </option>
                         </select>
                        </td>

                        <td class="p-3">   {{ $task->created_at->format('Y-m-d')              }}</td>

                        <td class="p-3 space-x-2">
                            <a href="{{ route('tasks.edit', $task->id) }}" 
                               class="bg-blue-600 hover:bg-blue-700   px-3 py-1 rounded text-white     text-sm">
                               Edit
                            </a>

                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-600     hover:bg-red-700 px-3 py-1 rounded text-white text-sm">
                                        Delete
                                </button>
                            </form>
                    </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-3 text-center text-gray-400">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $tasks->links('pagination::tailwind') }}
    </div>

    <!-- Success Alert -->
    <div id="alertBox" class="hidden mt-4 p-3 bg-green-700 text-white rounded">
         Status updated successfully
    </div>

</x-app-layout>


<script>
       document.getElementById('searchBox').addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#taskTable tr');

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
    document.querySelectorAll('.statusDropdown').forEach(dropdown => {
        const setDropdownColor = (el) => {
            switch(el.value){
                case 'pending':
                    el.style.backgroundColor = '#facc15';
                    el.style.color = 'black';
                    break;
                case 'in-progress':
                    el.style.backgroundColor = '#3b82f6';
                    el.style.color = 'white';
                    break;
                case 'completed':
                    el.style.backgroundColor = '#16a34a';
                    el.style.color = 'white';
                    break;
            }
        };
        setDropdownColor(dropdown);

        dropdown.addEventListener('change',function () {
        setDropdownColor(this);

            let taskId =this.getAttribute('data-id');
            let newStatus = this.value;

            fetch(`/tasks/${taskId}/status`, {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            })



            .then(response => response.json())
            .then(data => {
                let alertBox = document.getElementById('alertBox');
                alertBox.classList.remove('hidden');
                setTimeout(() => alertBox.classList.add('hidden'), 2000);
            });
        });
    });
</script>
