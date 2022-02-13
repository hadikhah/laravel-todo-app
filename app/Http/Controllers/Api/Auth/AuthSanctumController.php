<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\ValidationException;

class AuthSanctumController extends Controller
{

    /**
     * try to authenticate and return token
     *
     * @param LoginRequest $request
     * @return mixed
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        return response()->json($request->apiAuthenticate());
    }

    public function register(RegisterRequest $request)
    {
        $user = User::query()->create($request->validated());

        event(new Registered($user));

        dd($user->createToken());
    }

}
