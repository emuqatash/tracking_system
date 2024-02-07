<?php

namespace App\Policies;

use App\Models\DrivingLicense;
use App\Models\User;

class DrivingLicensePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasPermissionTo('Create DL')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
//    public function view(User $user, DrivingLicense $drivingLicense): bool
//    {
//        //
//    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasPermissionTo('Create DL')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DrivingLicense $drivingLicense): bool
    {
        if ($user->hasPermissionTo('Edit DL')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DrivingLicense $drivingLicense): bool
    {
        if ($user->hasPermissionTo('Delete DL')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DrivingLicense $drivingLicense): bool
    {
        if ($user->hasPermissionTo('Delete DL')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DrivingLicense $drivingLicense): bool
    {
        //
    }
}
