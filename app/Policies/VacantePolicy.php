<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacante;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;
use App\Enums\UserRoles;
use Illuminate\Support\Facades\Auth;

class VacantePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->rol_id === UserRoles::RECLUTADOR || $user->rol_id === UserRoles::ADMINISTRADOR;
    }

    /**
     * Determine whether the user can view the model.
     */

    public function view(?User $user, Vacante $vacante): bool
    {
        // Visitante (no autenticado)
        if (is_null($user)) {
            $this->vacanteDisponible($vacante);
            return true;
        }

        // Usuarios autenticados
        switch ($user->rol_id) {
            case UserRoles::POSTULANTE:
                $this->vacanteDisponible($vacante);
                return true;

            case UserRoles::RECLUTADOR:
                if ($user->id === $vacante->user_id) {
                    return true;
                } else {
                    $this->vacanteDisponible($vacante);
                    return true;
                }

            case UserRoles::ADMINISTRADOR:
                return true;

            default:
                return false;
        }
    }

    private function vacanteDisponible(Vacante $vacante): void
    {
        if ($vacante->ultimo_dia <= now()) {
            throw new AuthorizationException('Lo sentimos, esta vacante ya no está disponible.');
        }
    }



    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Solo admin puede saltarse la validación de pago
        if ($user->rol_id === UserRoles::ADMINISTRADOR) {
            return true;
        } elseif ($user->rol_id === UserRoles::POSTULANTE) {
            return false;
        }

        // Reclutadores necesitan pago vigente y créditos
        return $user->hasActivePayment();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vacante $vacante): bool
    {
        return $user->id === $vacante->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vacante $vacante): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Vacante $vacante): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Vacante $vacante): bool
    {
        return false;
    }
}
