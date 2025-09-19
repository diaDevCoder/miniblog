<?php

namespace App\Http\Controllers\User\Auth;

use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Mockery\Generator\StringManipulation\Pass\Pass;

class RegisterController extends Controller
{
    /**
     * Summary of store
     * @param \App\Http\Requests\RegisterRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('user')->plainTextToken;

        return $this->success('Registration successful.', [
            'user' => $user,
            'token' => $token,
        ]);
    }
}
