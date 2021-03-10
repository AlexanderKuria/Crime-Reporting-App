<?php

namespace App\Policies;

use App\Crime;
use App\Police;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CrimePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Crime  $crime
     * @return mixed
     */
    public function view(User $user, Crime $crime)
    {
        return $user->id == $crime->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Crime  $crime
     * @return mixed
     */
    public function update(User $user, Crime $crime)
    {
        if ($crime->status != 'unassigned')
            return false;
        return $user->id == $crime->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Crime  $crime
     * @return mixed
     */
    public function delete(User $user, Crime $crime)
    {
        if ($crime->status != 'unassigned')
            return false;
        return $user->id == $crime->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Crime  $crime
     * @return mixed
     */
    public function restore(User $user, Crime $crime)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Crime  $crime
     * @return mixed
     */
    public function forceDelete(User $user, Crime $crime)
    {
        return $this->delete($user, $crime);
    }
    public function updateState(Police $police, Crime $crime)
    {
        if ($crime->status == 'assigned' && $crime->status != 'closed'){
            return $police->id == $crime->police_id;
        }
        return false;
    }
}
