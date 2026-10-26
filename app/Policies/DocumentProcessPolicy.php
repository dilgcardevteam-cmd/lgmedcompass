<?php

namespace App\Policies;

use App\Models\DocumentProcess;
use App\Models\User;

class DocumentProcessPolicy
{
    /**
     * Determine if the user can view the "My Tasks" list.
     */
    public function viewAny(User $user): bool
    {
        // Technical Inspector needs to see the tasks assigned to them (read-only)
        return in_array($user->role, ['Admin', 'Employee', 'Technical Inspector']);
    }

    /**
     * Determine if the user can view a specific task (DocumentProcess).
     */
    public function view(User $user, DocumentProcess $documentProcess): bool
    {
        // Allow Technical Inspector if they are the assignee or the creator, or if the document is not draft
        if ($user->role === 'Technical Inspector') {
            // Technical Inspector should not see draft-related tasks
            if ($documentProcess->document && $documentProcess->document->status === 'draft') {
                return false;
            }

            return $user->id === $documentProcess->assigned_to_id ||
                   $user->id === $documentProcess->created_by;
        }

        // For other roles: Admin, Employee, or related users
        return $user->role === 'Admin' ||
               $user->id === $documentProcess->assigned_to_id ||
               $user->id === $documentProcess->created_by;
    }

    /**
     * Block all write operations for Technical Inspector.
     */
    public function create(User $user): bool
    {
        return $user->role !== 'Technical Inspector';
    }

    public function update(User $user, DocumentProcess $documentProcess): bool
    {
        return $user->role !== 'Technical Inspector';
    }

    public function delete(User $user, DocumentProcess $documentProcess): bool
    {
        return $user->role !== 'Technical Inspector';
    }
}
