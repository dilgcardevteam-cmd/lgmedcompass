<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;

class DocumentPolicy
{
    /**
     * Determine if the user can view any documents (index page).
     */
    public function viewAny(User $user): bool
    {
        // Technical Inspector can see the list of non-draft documents
        return in_array($user->role, ['Admin', 'Employee', 'Technical Inspector']);
    }

    /**
     * Determine if the user can view a specific document.
     */
    public function view(User $user, Document $document): bool
    {
        // Draft documents: only visible to Admin and the document creator
        if ($document->status === 'draft') {
            return $user->role === 'Admin' || $user->id === $document->created_by;
        }

        // Non-draft documents: Technical Inspector is allowed
        if ($user->role === 'Technical Inspector') {
            return true;
        }

        // For other roles: Admin, Employee, or user belonging to the document's section
        return $user->role === 'Admin' ||
               $user->id === $document->created_by ||
               $user->section_id === $document->section_id;
    }

    /**
     * Block all write operations for Technical Inspector.
     * These methods are never called because the middleware blocks write requests,
     * but we implement them for completeness.
     */
    public function create(User $user): bool
    {
        return $user->role !== 'Technical Inspector';
    }

    public function update(User $user, Document $document): bool
    {
        return $user->role !== 'Technical Inspector';
    }

    public function delete(User $user, Document $document): bool
    {
        return $user->role !== 'Technical Inspector';
    }
}
