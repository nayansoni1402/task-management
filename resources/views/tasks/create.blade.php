@extends('layouts.newapp')

@section('title', isset($task) ? 'Edit Task' : 'Create Task')
@section('content')
    <div class="container mt-5">
        <h1 class="text-center">{{ isset($task) ? 'Edit Task' : 'Create Task' }}</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($task))
                        @method('PUT') <!-- Include method spoofing for editing -->
                    @endif

                    <div class="form-group">
                        <label for="title">Task Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $task->description ?? '') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="priority">Priority</label>
                        <select name="priority" id="priority" class="form-control">
                            <option value="low" {{ (old('priority', $task->priority ?? '') == 'low') ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ (old('priority', $task->priority ?? '') == 'medium') ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ (old('priority', $task->priority ?? '') == 'high') ? 'selected' : '' }}>High</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="deadline">Deadline</label>
                        <input type="date" name="deadline" id="deadline" class="form-control" 
                               value="{{ old('deadline', isset($task) ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>

                        <select name="status" id="status" class="form-control">
                            <option value="pending" {{ (old('status', $task->status ?? '') == 'pending') ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ (old('status', $task->status ?? '') == 'completed') ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="document">Attach Document</label>
                        <input type="file" name="document" id="document" class="form-control" onchange="previewFile()">
                    
                        <!-- Preview Section -->
                        <div class="mt-3" id="preview">
                            @if (isset($task) && $task->documents->count() > 0)
                                <p class="mt-2">Current Documents:</p>
                                <ul>
                                    @foreach ($task->documents as $document)
                                        <li>
                                            @if (in_array(pathinfo($document->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ Storage::url($document->file_path) }}" alt="Document Image" style="max-width: 150px;">
                                            @else
                                                <a href="{{ Storage::url($document->file_path) }}" target="_blank">View Document</a> 
                                                | 
                                                @endif
                                                <a href="{{ Storage::url($document->file_path) }}" download>Download</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">{{ isset($task) ? 'Update Task' : 'Create Task' }}</button>
                </form>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function previewFile() {
            const file = document.querySelector('#document').files[0];
            const preview = document.querySelector('#preview');
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function (e) {
                    // Clear the current preview
                    preview.innerHTML = '';
                    
                    // Check if the file is an image
                    if (file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '150px'; // Set the preview size
                        preview.appendChild(img);
                    } else {
                        // Display a link if it's not an image
                        const link = document.createElement('a');
                        link.href = e.target.result;
                        link.textContent = 'View Document';
                        link.target = '_blank';
                        preview.appendChild(link);
                    }
                }
                
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection