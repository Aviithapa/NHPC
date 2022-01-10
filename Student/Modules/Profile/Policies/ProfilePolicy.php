<?php


namespace Student\Modules\Profile\Policies;


use App\Models\Auth\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{

    use HandlesAuthorization;

    /**
     * Checks the user permission to READ site settings
     * @param User $user
     * @return bool
     */
    public function read(User $user)
    {
        if($user->can('profile-read') || $user->can('profile-read')) {
            return true;
        }
        return false;
    }


    /**
     * Checks the user permission to CREATE site settings
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        if($user->can('profile-create') || $user->can('profile-create')) {
            return true;
        }
        return false;
    }
    /**
     * Checks the user permission to UPDATE site settings
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        if($user->can('profile-update') || $user->can('profile-update')) {
            return true;
        }
        return false;
    }

    /**
     * Checks the user permission to DELETE site settings
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        if($user->can('profile-delete') || $user->can('profile-delete')) {
            return true;
        }
        return false;
    }
}
