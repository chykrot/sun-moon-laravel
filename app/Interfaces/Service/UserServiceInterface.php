<?php

namespace App\Interfaces\Service;


interface UserServiceInterface
{
    /**
     * Authenticate user
     * 
     * @param  array $request
     * @return \Illuminate\Http\Response
     */
    public function login(array $request);

    /**
     * Get the user details.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id);

}