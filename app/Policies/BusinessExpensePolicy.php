<?php

namespace App\Policies;

use App\Models\BusinessExpense;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class BusinessExpensePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Create BusinessExpense');
    }


//    public function view(User $user, BusinessExpense $businessExpense): bool
//    {
//    }


    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Create BusinessExpense');
    }


    public function update(User $user, BusinessExpense $businessExpense): bool
    {
        return $user->hasPermissionTo('Edit BusinessExpense');
    }


    public function delete(User $user, BusinessExpense $businessExpense): bool
    {
        return $user->hasPermissionTo('Delete BusinessExpense');
    }


    public function restore(User $user, BusinessExpense $businessExpense): bool
    {
    }


    public function forceDelete(User $user, BusinessExpense $businessExpense): bool
    {
    }
}
