<?php

namespace App\Policies;

use App\Models\Part;
use App\Models\User;

class PartPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasPermissionTo('Create Part')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
//    public function view(User $user, Part $part): bool
//    {
//        //
//    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasPermissionTo('Create Shop')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Part $part): bool
    {
        if ($user->hasPermissionTo('Edit Part')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Part $part): bool
    {
        if ($user->hasPermissionTo('Delete Part') && $part->account_id === $user->account_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Part $part): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Part $part): bool
    {
        //
    }
}
