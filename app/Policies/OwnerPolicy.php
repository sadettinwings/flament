<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Owner;
use Illuminate\Auth\Access\HandlesAuthorization;

class OwnerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the owner can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the owner can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Owner  $model
     * @return mixed
     */
    public function view(User $user, Owner $model)
    {
        return true;
    }

    /**
     * Determine whether the owner can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the owner can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Owner  $model
     * @return mixed
     */
    public function update(User $user, Owner $model)
    {
        return true;
    }

    /**
     * Determine whether the owner can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Owner  $model
     * @return mixed
     */
    public function delete(User $user, Owner $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Owner  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the owner can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Owner  $model
     * @return mixed
     */
    public function restore(User $user, Owner $model)
    {
        return false;
    }

    /**
     * Determine whether the owner can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Owner  $model
     * @return mixed
     */
    public function forceDelete(User $user, Owner $model)
    {
        return false;
    }
}
