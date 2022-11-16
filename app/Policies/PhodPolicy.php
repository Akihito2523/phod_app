<?php

namespace App\Policies;

use App\Models\Phod;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhodPolicy {
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user) {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Phod  $phod
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Phod $phod) {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user) {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Phod  $phod
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Phod $phod) {
        return $user->id === $phod->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Phod  $phod
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Phod $phod) {
        return $user->id === $phod->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Phod  $phod
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Phod $phod) {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Phod  $phod
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Phod $phod) {
        //
    }
}
