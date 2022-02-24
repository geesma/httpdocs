<?php

namespace App\Policies;

use App\Models\Temporada;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TemporadaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Temporada  $temporada
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Temporada $temporada)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Temporada  $temporada
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Temporada $temporada)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Temporada  $temporada
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Temporada $temporada)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Temporada  $temporada
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Temporada $temporada)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Temporada  $temporada
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Temporada $temporada)
    {
        //
    }
}
