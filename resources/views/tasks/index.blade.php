<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Link to your app's CSS -->
</head>
<body>
    <div class="container mx-auto mt-5">
        <h1 class="text-2xl font-bold">Task List</h1>
        <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create New Task</a>
        <table class="min-w-full mt-4 bg-white">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4">Title</th>
                    <th class="py-2 px-4">Description</th>
                    <th class="py-2 px-4">Priority</th>
                    <th class="py-2 px-4">Deadline</th>
                    <th class="py-2 px-4">Status</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td class="border px-4 py-2">{{ $task->title }}</td>
                        <td class="border px-4 py-2">{{ $task->description }}</td>
                        <td class="border px-4 py-2">{{ $task->priority }}</td>
                        <td class="border px-4 py-2">{{ $task->deadline->format('Y-m-d') }}</td>
                        <td class="border px-4 py-2">{{ $task->status }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($tasks->isEmpty())
            <p class="mt-4">No tasks found.</p>
        @endif
    </div>
</body>
</html>