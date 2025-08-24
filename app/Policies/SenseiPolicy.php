<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Sensei;
use Illuminate\Auth\Access\HandlesAuthorization;

class SenseiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_sensei');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Sensei $sensei): bool
    {
        return $user->can('view_sensei');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_sensei');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Sensei $sensei): bool
    {
        return $user->can('update_sensei');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Sensei $sensei): bool
    {
        return $user->can('delete_sensei');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_sensei');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Sensei $sensei): bool
    {
        return $user->can('force_delete_sensei');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_sensei');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Sensei $sensei): bool
    {
        return $user->can('restore_sensei');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_sensei');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Sensei $sensei): bool
    {
        return $user->can('replicate_sensei');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_sensei');
    }
}
