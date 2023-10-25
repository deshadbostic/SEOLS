<?php

namespace App\Policies;

use App\Models\Inverter;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InverterPolicy
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
    public function view(User $user, Inverter $inverter): bool
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
    public function update(User $user, Inverter $inverter): bool
    {
        //
        return $user->role == "piDSSAdministrator" || $user->role == "operationsManager";
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Inverter $inverter): bool
    {
        //
        return $user->role == "piDSSAdministrator" || $user->role == "operationsManager";
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Inverter $inverter): bool
    {
        //
        return $user->role == "piDSSAdministrator" || $user->role == "operationsManager";
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Inverter $inverter): bool
    {
        //
        return $user->role == "piDSSAdministrator" || $user->role == "operationsManager";
    }
}
