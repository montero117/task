<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks=Task::all();
        return view("welcome",['tasks'=>$tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Crea la tarea en la base de datos
        $task = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        // Puedes devolver una respuesta JSON si lo deseas
        return response()->json(['message' => 'Tarea creada con éxito', 'task' => $task]);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Encuentra la tarea por su ID
        $task = Task::findOrFail($id);

        // Actualiza los campos de la tarea con los datos proporcionados en la solicitud
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        // Puedes redirigir a la página de detalles de la tarea o devolver una respuesta JSON si lo deseas
        return response()->json(['message' => 'Tarea actualizada con éxito', 'task' => $task]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Tarea eliminada con éxito']);
    }
}
