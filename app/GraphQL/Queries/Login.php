<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Exceptions\CustomException;
use App\Models\AuthToken;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;

final readonly class Login
{
    /** @param  array{}  $args */
    public function __invoke( $_, array $args)
    {

        $guard = 'json_login';
        /** @var User $user */
        $user = \Auth::guard($guard)->loginViaCredentials($args);

        if(!$user){
            throw new AuthenticationException(
                'Unauthenticated.', [$guard]
            );
        }

        return new AuthToken(
            $user->createToken("default")->plainTextToken,
            $user->name,
            $user->role,
        );
        // TODO implement the resolver
    }
}
