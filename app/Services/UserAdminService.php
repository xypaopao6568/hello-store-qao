<?php

/**
 * User: ilovephp106@gmail.com
 * Date: 8/10/2023
 * Time: 9:22 PM
 */

namespace App\Services;

use App\Models\Role;
use App\Models\User;

class UserAdminService
{
    protected $user;
    protected $role;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function getEdit($request)
    {
        if ($request->id) {
            return $this->user->find($request->id);
        }
    }
}
