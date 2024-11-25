<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\AuthToken;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;

final readonly class Login
{
    private const  GUARD = 'json_login';

    /** @param  array{}  $args */
    public function __invoke($_, array $args)
    {

        /** @var User $user */
        $user = \Auth::guard(self::GUARD)->loginViaCredentials($args);

        if (! $user) {
            throw new AuthenticationException(
                'Unauthenticated.',
                [self::GUARD]
            );
        }

        return new AuthToken(
            $user->createToken('default')->plainTextToken,
            $user->name,
            $user->role,
        );
    }
}
