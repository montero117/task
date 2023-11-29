<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
   
    public function index()
    {
        $tasks=Task::all();
        $tasksDone = Task::where('status', 'completada')->count();
        $tasksTodo = Task::where('status', 'pendiente')->count();
        return view("main",['tasks'=>$tasks,'tasksDone'=> $tasksDone,'tasksTodo'=>$tasksTodo]);
    }

  
    public function create()
    {
       
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $task = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return response()->json(['message' => 'Tarea creada con éxito', 'task' => $task]);
    }
    

  
    public function show(string $id)
    {
        
    }

    
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

       
        $task = Task::findOrFail($id);

        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return response()->json(['message' => 'Tarea actualizada con éxito', 'task' => $task]);
    }

    public function updateStatusTask(Request $request, string $id)
    {
       
        $task = Task::findOrFail($id);
        
        $task->update([
            'status' => ($task->status ==='pendiente') ? 'completada' : 'pendiente',
        ]);

        return response()->json(['message' => 'Tarea actualizada con éxito', 'task' => $task]);
    }

    
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Tarea eliminada con éxito']);
    }
}
