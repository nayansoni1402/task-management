<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Document;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
   
        $tasks = auth()->user()->tasks;
        // dd($tasks->toarray());
        return view('tasks.index', compact('tasks')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Task::class);

        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|string',
            'deadline' => 'required|date',
        ]);
    
        $this->authorize('create', Task::class);

        Task::create(array_merge($validated, ['user_id' => auth()->id()]));
    
        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return view('tasks.show', compact('task')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|string',
            'deadline' => 'required|date',
        ]);

        $this->authorize('update', $task);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    /**
     * Upload document for a task.
     */
    public function uploadDocument(Request $request, Task $task)
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $this->authorize('upload', Document::class);

        $path = $request->file('document')->store('documents'); 

        $document = new Document();
        $document->task_id = $task->id;
        $document->file_path = $path; 
        $document->save();

        return back()->with('success', 'Document uploaded successfully.');
    }
}