<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Duty;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DutyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_duty');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  Duty  $duty
     * @return bool
     */
    public function view(User $user, Duty $duty): bool
    {
        return $user->can('view_duty');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_duty');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Duty  $duty
     * @return bool
     */
    public function update(User $user, Duty $duty): bool
    {
        return $user->can('update_duty');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Duty  $duty
     * @return bool
     */
    public function delete(User $user, Duty $duty): bool
    {
        return $user->can('delete_duty');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_duty');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  User  $user
     * @param  Duty  $duty
     * @return bool
     */
    public function forceDelete(User $user, Duty $duty): bool
    {
        return $user->can('force_delete_duty');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_duty');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  User  $user
     * @param  Duty  $duty
     * @return bool
     */
    public function restore(User $user, Duty $duty): bool
    {
        return $user->can('restore_duty');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  User  $user
     * @return bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_duty');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  User  $user
     * @param  Duty  $duty
     * @return bool
     */
    public function replicate(User $user, Duty $duty): bool
    {
        return $user->can('replicate_duty');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  User  $user
     * @return bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_duty');
    }

}
