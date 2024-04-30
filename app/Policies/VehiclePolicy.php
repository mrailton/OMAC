<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Auth\Access\HandlesAuthorization;

class VehiclePolicy
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
        return $user->can('view_any_vehicle');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  Vehicle  $vehicle
     * @return bool
     */
    public function view(User $user, Vehicle $vehicle): bool
    {
        return $user->can('view_vehicle');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_vehicle');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Vehicle  $vehicle
     * @return bool
     */
    public function update(User $user, Vehicle $vehicle): bool
    {
        return $user->can('update_vehicle');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Vehicle  $vehicle
     * @return bool
     */
    public function delete(User $user, Vehicle $vehicle): bool
    {
        return $user->can('delete_vehicle');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_vehicle');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  User  $user
     * @param  Vehicle  $vehicle
     * @return bool
     */
    public function forceDelete(User $user, Vehicle $vehicle): bool
    {
        return $user->can('force_delete_vehicle');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_vehicle');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  User  $user
     * @param  Vehicle  $vehicle
     * @return bool
     */
    public function restore(User $user, Vehicle $vehicle): bool
    {
        return $user->can('restore_vehicle');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  User  $user
     * @return bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_vehicle');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  User  $user
     * @param  Vehicle  $vehicle
     * @return bool
     */
    public function replicate(User $user, Vehicle $vehicle): bool
    {
        return $user->can('replicate_vehicle');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  User  $user
     * @return bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_vehicle');
    }

}
