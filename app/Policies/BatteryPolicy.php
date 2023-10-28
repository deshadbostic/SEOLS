<?php

namespace App\Policies;

use App\Models\Battery;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BatteryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Battery $battery): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->role == "piDSSAdministrator" || $user->role == "operationsManager";
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Battery $battery): bool
    {
        //
        return $user->role == "piDSSAdministrator" || $user->role == "operationsManager";
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Battery $battery): bool
    {
        //
        return $user->role == "piDSSAdministrator" || $user->role == "operationsManager";
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Battery $battery): bool
    {
        //
        return $user->role == "piDSSAdministrator" || $user->role == "operationsManager";
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Battery $battery): bool
    {
        //
        return $user->role == "piDSSAdministrator" || $user->role == "operationsManager";
    }
}
