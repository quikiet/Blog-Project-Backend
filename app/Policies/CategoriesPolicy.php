<?php

namespace App\Policies;

use App\Models\User;
use App\Models\categories;
use Illuminate\Auth\Access\Response;

class CategoriesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, categories $categories): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('Bạn không có quyền để thêm danh này.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, categories $categories): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, categories $categories): Response
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('Bạn không có quyền để thêm danh này.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, categories $categories): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, categories $categories): bool
    {
        return false;
    }
}
