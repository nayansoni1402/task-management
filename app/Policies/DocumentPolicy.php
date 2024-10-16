<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
{
    use HandlesAuthorization;

    public function upload(User $user, Document $document)
    {
        return $user->id === $document->task->user_id || $user->role === 'admin';
    }
}