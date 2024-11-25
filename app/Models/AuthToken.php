<?php

namespace App\Models;

use App\Models\Enums\UserRoleEnum;

class AuthToken
{
    public function __construct(
        public string $token,
        public string $name,
        public UserRoleEnum $role,
    ) {
    }
}
