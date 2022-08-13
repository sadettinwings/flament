<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Destinations;
use Illuminate\Auth\Access\HandlesAuthorization;

class DestinationsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the destinations can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list alldestinations');
    }

    /**
     * Determine whether the destinations can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Destinations  $model
     * @return mixed
     */
    public function view(User $user, Destinations $model)
    {
        return $user->hasPermissionTo('view alldestinations');
    }

    /**
     * Determine whether the destinations can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create alldestinations');
    }

    /**
     * Determine whether the destinations can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Destinations  $model
     * @return mixed
     */
    public function update(User $user, Destinations $model)
    {
        return $user->hasPermissionTo('update alldestinations');
    }

    /**
     * Determine whether the destinations can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Destinations  $model
     * @return mixed
     */
    public function delete(User $user, Destinations $model)
    {
        return $user->hasPermissionTo('delete alldestinations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Destinations  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete alldestinations');
    }

    /**
     * Determine whether the destinations can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Destinations  $model
     * @return mixed
     */
    public function restore(User $user, Destinations $model)
    {
        return false;
    }

    /**
     * Determine whether the destinations can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Destinations  $model
     * @return mixed
     */
    public function forceDelete(User $user, Destinations $model)
    {
        return false;
    }
}
