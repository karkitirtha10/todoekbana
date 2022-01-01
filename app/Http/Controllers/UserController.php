<?php

namespace App\Http\Controllers;

use App\Contracts\IUserService;
use App\Http\Requests\Main\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(private ResponseFactory $response)
    {
    }

    public function register(RegisterUserRequest $request, Hasher $hasher) : JsonResponse
    {
        $inputs = $request->validated();

        $newUser = new User([
            "name" => $inputs["name"],
            "email" => $inputs["email"],
            "password" => $hasher->make($inputs["password"])
        ]);
        $newUser->save();

        return $this->response->createdAtAction($newUser);
    }

    public function login(IUserService $userService, LoginUserRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);
        $selected_user = $userService->attempt($credentials);
        $token = $selected_user->createToken('access_token')->accessToken;
        $appData = $userService->initializeAppData($selected_user);


        return $this->response->ok([
                'access_token' => 'Bearer ' . $token,
            ] + $appData, 'Successful authentication!');
    }


}
