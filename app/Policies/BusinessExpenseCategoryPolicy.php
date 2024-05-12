<?php

namespace App\Policies;

use App\Models\BusinessExpenseCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessExpenseCategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('Create BusinessExpense Category');
    }

//    public function view(User $user, BusinessExpenseCategory $businessExpenseCategory): bool
//    {
//    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Create BusinessExpense Category');
    }

    public function update(User $user, BusinessExpenseCategory $businessExpenseCategory): bool
    {
        return $user->hasPermissionTo('Edit BusinessExpense Category');
    }

    public function delete(User $user, BusinessExpenseCategory $businessExpenseCategory): bool
    {
        return $user->hasPermissionTo('Delete BusinessExpense Category');
    }


    public function restore(User $user, BusinessExpenseCategory $businessExpenseCategory): bool
    {
        //
    }


    public function forceDelete(User $user, BusinessExpenseCategory $businessExpenseCategory): bool
    {
        //
    }
}
