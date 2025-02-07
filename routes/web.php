<?php
// app/Http/Controllers/TaskController.php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index']);
Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
Route::post('/task/delete/{id}', [TaskController::class, 'delete'])->name('task.delete');
Route::post('/task/clear', [TaskController::class, 'clear'])->name('task.clear');



use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = session('tasks', []);
        return view('index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate(['task' => 'required|string']);
        $tasks = session('tasks', []);
        $tasks[] = $request->task;
        session(['tasks' => $tasks]);
        return redirect('/');
    }

    public function delete($id)
    {
        $tasks = session('tasks', []);
        if (isset($tasks[$id])) {
            unset($tasks[$id]);
            session(['tasks' => array_values($tasks)]);
        }
        return redirect('/');
    }

    public function clear()
    {
        session()->forget('tasks');
        return redirect('/');
    }
}
