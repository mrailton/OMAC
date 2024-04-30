<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrainingSessionPolicy
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
        return $user->can('view_any_training::sessions');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  TrainingSession  $trainingSession
     * @return bool
     */
    public function view(User $user, TrainingSession $trainingSession): bool
    {
        return $user->can('view_training::sessions');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_training::sessions');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  TrainingSession  $trainingSession
     * @return bool
     */
    public function update(User $user, TrainingSession $trainingSession): bool
    {
        return $user->can('update_training::sessions');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  TrainingSession  $trainingSession
     * @return bool
     */
    public function delete(User $user, TrainingSession $trainingSession): bool
    {
        return $user->can('delete_training::sessions');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_training::sessions');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  User  $user
     * @param  TrainingSession  $trainingSession
     * @return bool
     */
    public function forceDelete(User $user, TrainingSession $trainingSession): bool
    {
        return $user->can('force_delete_training::sessions');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_training::sessions');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  User  $user
     * @param  TrainingSession  $trainingSession
     * @return bool
     */
    public function restore(User $user, TrainingSession $trainingSession): bool
    {
        return $user->can('restore_training::sessions');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  User  $user
     * @return bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_training::sessions');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  User  $user
     * @param  TrainingSession  $trainingSession
     * @return bool
     */
    public function replicate(User $user, TrainingSession $trainingSession): bool
    {
        return $user->can('replicate_training::sessions');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  User  $user
     * @return bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_training::sessions');
    }

}
