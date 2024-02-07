<?php

namespace App\Policies;

use App\Models\MiscellaneousCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MiscellaneousCategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Create Category');
    }

//    public function view(User $user, MiscellaneousCategory $miscellaneousCategory): bool
//    {
//    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Create Category');
    }

    public function update(User $user, MiscellaneousCategory $miscellaneousCategory): bool
    {
        return $user->hasPermissionTo('Edit Category');
    }

    public function delete(User $user, MiscellaneousCategory $miscellaneousCategory): bool
    {
        return $user->hasPermissionTo('Delete Category');
    }

    public function restore(User $user, MiscellaneousCategory $miscellaneousCategory): bool
    {
    }

    public function forceDelete(User $user, MiscellaneousCategory $miscellaneousCategory): bool
    {
    }
}
