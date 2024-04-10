<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{

    public function showLoginForm()
    {
            return view('auth.login');
    }


    public function issueToken(Request $request)
    {
        return $request->user()->createToken("default")->plainTextToken;
    }
}
