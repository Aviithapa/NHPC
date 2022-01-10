<?php

namespace App\Models\Auth;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;


class User extends Authenticatable
{
    use Notifiable, LaratrustUserTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number','status'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token','password'
    ];


    /**
     * Checks if user is super admin
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->hasRole(['administrator']) ? true : false;

    }

    /**
     * Displays the single role of user from many-many relationship
     * @return mixed
     */
    public function mainRole()
    {
        return self::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->select('roles.*')
            ->where('users.id', $this->id)->first();
    }

    public function active()
    {
        if($this->status == 'active') {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * @return string
     */



}
