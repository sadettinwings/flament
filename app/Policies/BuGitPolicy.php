<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BuGit;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuGitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the buGit can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list bugits');
    }

    /**
     * Determine whether the buGit can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BuGit  $model
     * @return mixed
     */
    public function view(User $user, BuGit $model)
    {
        return $user->hasPermissionTo('view bugits');
    }

    /**
     * Determine whether the buGit can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create bugits');
    }

    /**
     * Determine whether the buGit can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BuGit  $model
     * @return mixed
     */
    public function update(User $user, BuGit $model)
    {
        return $user->hasPermissionTo('update bugits');
    }

    /**
     * Determine whether the buGit can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BuGit  $model
     * @return mixed
     */
    public function delete(User $user, BuGit $model)
    {
        return $user->hasPermissionTo('delete bugits');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BuGit  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete bugits');
    }

    /**
     * Determine whether the buGit can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BuGit  $model
     * @return mixed
     */
    public function restore(User $user, BuGit $model)
    {
        return false;
    }

    /**
     * Determine whether the buGit can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BuGit  $model
     * @return mixed
     */
    public function forceDelete(User $user, BuGit $model)
    {
        return false;
    }
}
