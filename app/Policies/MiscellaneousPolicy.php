<?php

namespace App\Policies;

use App\Models\Miscellaneous;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MiscellaneousPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Create Miscellaneous');
    }

//    public function view(User $user, Miscellaneous $miscellaneous): bool
//    {
//    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Create Miscellaneous');
    }

    public function update(User $user, Miscellaneous $miscellaneous): bool
    {
        return $user->hasPermissionTo('Edit Miscellaneous');
    }

    public function delete(User $user, Miscellaneous $miscellaneous): bool
    {
        return $user->hasPermissionTo('Delete Miscellaneous');
    }

    public function restore(User $user, Miscellaneous $miscellaneous): bool
    {
    }

    public function forceDelete(User $user, Miscellaneous $miscellaneous): bool
    {
    }
}
