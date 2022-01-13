<?php

namespace App\Services;


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
        return $request;
    }

    /**
     * Get the user details.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return $id;
    }
}