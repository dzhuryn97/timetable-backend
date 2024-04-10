<?php

namespace App\Http\Auth;

use App\Models\User;
use Hash;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class JsonLoginGuard implements Guard
{
    use GuardHelpers;

    private Request $request;
    private UserProvider $userProvider;

    public function __construct(UserProvider $userProvider, Request $request)
    {
        $this->request = $request;
        $this->userProvider = $userProvider;
    }

    public function user()
    {
        if (!is_null($this->user)) {
            return $this->user;
        }

        $credentials = [
            'email' => $this->request->email,
            'password' => $this->request->password,
        ];

        return $this->loginViaCredentials($credentials);
    }


    public function validate(array $credentials = [])
    {
        $user = $this->userProvider->retrieveByCredentials($credentials);

        return $user && $this->hasValidCredentials($user, $credentials);
    }

    protected function hasValidCredentials($user, $credentials)
    {
        return $this->userProvider->validateCredentials($user, $credentials);
    }


    public function loginViaCredentials($credentials)
    {
        $user = $this->userProvider->retrieveByCredentials($credentials);

        if ($user && $this->hasValidCredentials($user, $credentials)) {
            $this->setUser($user);
            return $user;
        }

        return null;
    }

}
