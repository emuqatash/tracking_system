<?php

namespace App\Policies;

use App\Models\Shop;
use App\Models\User;

class ShopPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasPermissionTo('Create Shop')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
//    public function view(User $user, Shop $Shop): bool
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
    public function update(User $user, Shop $Shop): bool
    {
        if ($user->hasPermissionTo('Edit Shop')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Shop $shop): bool
    {

        if ($user->hasPermissionTo('Delete Shop') && $shop->account_id === $user->account_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Shop $Shop): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Shop $Shop): bool
    {
        //
    }
}
