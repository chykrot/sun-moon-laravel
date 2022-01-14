<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ Auth, Hash };
use App\Interfaces\Service\UserServiceInterface;

class UserService implements UserServiceInterface
{
    /**
     * Authenticate user
     * 
     * @param  array $request
     * @return \Illuminate\Http\Response
     */
    public function login(array $request)
    {
        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        $user = User::where('email', $request['email'])->first();

        $token = $user->createToken('access-token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user]);
    }

    /**
     * Get the user details.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return User::findOrFail($id);
    }

    /**
     * Logout user.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout($request)
    {
        return request()->user()->currentAccessToken()->delete();
    }
}



