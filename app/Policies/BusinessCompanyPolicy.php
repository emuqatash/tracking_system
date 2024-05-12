<?php

namespace App\Policies;

use App\Models\BusinessCompany;
use App\Models\User;

class BusinessCompanyPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Create BusinessCompany');
    }


//    public function view(User $user, BusinessCompany $businessCompany): bool
//    {
//    }


    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Create BusinessCompany');
    }


    public function update(User $user, BusinessCompany $businessCompany): bool
    {
        return $user->hasPermissionTo('Edit BusinessCompany');
    }


    public function delete(User $user, BusinessCompany $businessCompany): bool
    {
        return $user->hasPermissionTo('Delete BusinessCompany');
    }


    public function restore(User $user, BusinessCompany $businessCompany): bool
    {
        //
    }


    public function forceDelete(User $user, BusinessCompany $businessCompany): bool
    {
        //
    }
}
