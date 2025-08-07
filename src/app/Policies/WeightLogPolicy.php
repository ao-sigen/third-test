<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Auth\Access\HandlesAuthorization;

class WeightLogPolicy
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
     * @param  \App\Models\WeightLog  $weightLog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, WeightLog $log)
    {
        return $user->id === $log->user_id;
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
     * @param  \App\Models\WeightLog  $weightLog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, WeightLog $weightLog)
    {
        return $user->id === $weightLog->user_id;
    }


    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WeightLog  $weightLog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, WeightLog $weightLog)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WeightLog  $weightLog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, WeightLog $weightLog)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WeightLog  $weightLog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, WeightLog $weightLog)
    {
        //
    }
}
