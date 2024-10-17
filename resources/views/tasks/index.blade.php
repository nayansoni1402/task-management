<!-- resources/views/tasks/index.blade.php -->

@extends('layouts.newapp')

@section('title', 'Task List')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Task List Title -->
        <h1 class="h5">Task List</h1>

        <!-- Create New Task Button -->
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
    </div>
    <!-- Display success message -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Authour</th>
                <th>Title</th>
                <th>Description</th>
                <th>Priority</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->user->name ?? 'No User' }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ ucfirst($task->priority) }}</td>
                <td>{{ $task->deadline }}</td>
                <td>{{ ucfirst($task->status) }}</td>
                <td>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
                    {{-- @can('delete', $task) --}}
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    {{-- @endcan --}}

                    {{-- @cannot('delete', $task)
                    <span class="text-danger">You do not have permission to delete this task.</span>
                    @endcannot --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection