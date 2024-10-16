<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        // return $user->id === $task->user_id || $user->role === 'admin';

        return in_array($user->role, ['admin', 'manager','user']);
    }

    public function view(User $user, Task $task)
    {
        // Define logic to check if the user can view the task
        return $user->id === $task->user_id || $user->role === 'admin';
    }

    public function update(User $user, Task $task)
    {
        // Define logic to check if the user can update the task
        return $user->id === $task->user_id || $user->role === 'admin';
    }

    public function delete(User $user, Task $task)
    {
        // Define logic to check if the user can delete the task
        return $user->id === $task->user_id || $user->role === 'admin';
    }
}