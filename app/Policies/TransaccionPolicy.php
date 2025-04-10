<?php

namespace App\Policies;

use App\Enums\UserRoles;
use App\Models\Transaccion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TransaccionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return auth()->user()->rol_id === UserRoles::ADMINISTRADOR;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Transaccion $transaccion): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Transaccion $transaccion): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Transaccion $transaccion): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Transaccion $transaccion): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Transaccion $transaccion): bool
    {
        return false;
    }
}
