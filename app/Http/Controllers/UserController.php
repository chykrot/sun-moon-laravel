<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ShowUserRequest;
use App\Interfaces\Service\UserServiceInterface;


class UserController extends Controller
{
    /**
     * Inject Dependencies
     * 
     * @param \App\Interfaces\Service\UserServiceInterface
     */
    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Authenticate user
     *
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        return $this->service->login($request->validated());
    }

    /**
     * Get the user details.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return $this->service->show($id);
    }

    /**
     * Logout the user.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        return $this->service->logout($request);
    }
}
