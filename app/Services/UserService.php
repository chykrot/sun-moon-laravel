<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        return $user->createToken('access-token');
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
}