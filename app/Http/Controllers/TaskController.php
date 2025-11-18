<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->latest()->paginate(3);

        return view('tasks.index', compact('tasks'));
    }




    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' =>        'required|min:3|max:100',
            'description' => 'nullable'
        ]);

        Task::create([
            'title' => $request->title,
            'description' =>$request->description,
            'status' => 'pending',
            'user_id' => Auth::id(),
        ]);




        return redirect()->route('tasks.index')->with('success',    'Task created!');
    }

    public function edit(Task $task)

    {
        $this->authorizeTask($task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        $request->validate([


            'title' => 'required|min:3|max:100',

            'description' => 'nullable',

            'status' => 'required|in:pending,in-progress,completed'
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated!');
    }

    public function destroy(Task $task)
    {
        $this->authorizeTask($task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted!');
    }

    private function authorizeTask($task)
    {
        if ($task->user_id !== Auth::id()) {

            abort(403, 'Unauthorized');
        }
    }

    public function updateStatus(Request $request, Task $task)
{
    $this->authorizeTask($task);

    $request->validate([

        'status' =>'required|in:pending,in-progress,completed'

    ]);

    $task->update(['status' =>$request->status]);

    return response()->json(['success' => true]);
}

}
?>