<?php

namespace SuperAdmin\Models\Auth;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    public $fillable = [
        'name',
        'display_name',
        'description'
    ];
}
