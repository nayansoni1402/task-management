<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (auth()->user()->role === 'admin') {
            $tasks = Task::all();
        } else {

            $tasks = auth()->user()->tasks;
        }
        // dd($tasks->toarray());
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $this->authorize('create', Task::class);

            return view('tasks.create');
        } catch (AuthorizationException $e) {
            return redirect()->route('tasks.index')->with('error', 'You are not authorized to create a task.');
        } catch (\Exception $e) {
            return redirect()->route('tasks.index')->with('error', 'An error occurred while trying to create a task.');
        }
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
            'status' => 'required|string',
            'document' => 'nullable|file|mimes:pdf,doc,docx,png,jpg|max:2048',
        ]);

        $this->authorize('create', Task::class);
        $task = Task::create(array_merge($validated, ['user_id' => auth()->id()]));
        if ($request->hasFile('document')) {
            $this->uploadDocument($request, $task);
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return view('tasks.create', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return view('tasks.create', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // dd($request->toarray());
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'priority' => 'required|string',
                'deadline' => 'required|date',
                'document' => 'nullable|file|mimes:pdf,doc,docx,png,jpg|max:2048',
            ]);

            $this->authorize('update', $task);

            $task->update($validated);

            if ($request->hasFile('document')) {
                $this->uploadDocument($request, $task);
            }
            return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
        } catch (AuthorizationException $e) {
            return redirect()->route('tasks.index')->with('error', 'This action is unauthorized.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('tasks.index')->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->route('tasks.index')->with('error', 'An error occurred while updating the task.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {

        try {
            $this->authorize('delete', $task);

            if ($task->documents) {
                foreach ($task->documents as $document) {
                    // Delete the file from storage
                    Storage::delete($document->file_path);
                    $document->delete(); // Delete the document record from the database
                }
            }
            $task->delete();

            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
        } catch (AuthorizationException $e) {
            return redirect()->route('tasks.index')->with('error', 'This action is unauthorized.');
        } catch (\Exception $e) {
            return redirect()->route('tasks.index')->with('error', 'An error occurred while deleting the task.');
        }
    }

    /**
     * Upload document for a task.
     */
    protected function uploadDocument($request, $task)
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf,doc,docx,png,jpg|max:2048',
        ]);

        $path = $request->file('document')->store('documents', 'public');

        $document = new Document();
        $document->task_id = $task->id;
        $document->file_path = $path;
        $document->save();

        return back()->with('success', 'Document uploaded successfully.');
    }

    public function loginAsUser($userId)
    {
        try {
            // Find the user by ID
            $user = User::findOrFail($userId); 
    
            // Log the user in
            Auth::login($user);
    
            return redirect()->route('tasks.index')->with('success', 'Successfully logged in as ' . $user->role);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('tasks.index')->with('error', 'User not found.');
        } catch (AuthorizationException $e) {
            return redirect()->route('tasks.index')->with('error', 'This action is unauthorized.');
        } catch (\Exception $e) {
            return redirect()->route('tasks.index')->with('error', 'An error occurred while logging in.');
        }
    }
}
