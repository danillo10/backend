<?php

namespace App\Http\Controllers\Auth\Helpers;

use Illuminate\Http\Request;

class Util
{
    public static function buildRoles($roles)
    {

        if (!is_array($roles)) {
            throw new \Exception("Parameter type must be array");
        }

        $rolesWithComma = implode(",", $roles);
        return "auth.role:$rolesWithComma";
    }
}
