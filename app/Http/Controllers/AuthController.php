<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function issueToken(Request $request)
    {
        return $request->user()->createToken('default')->plainTextToken;
    }
}
