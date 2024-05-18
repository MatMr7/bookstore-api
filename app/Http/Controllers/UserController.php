<?php

namespace App\Http\Controllers;

use App\Domain\User\Services\UserService;
use App\Http\Requests\User\CreateUserRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    )
    {
    }

    public function create(CreateUserRequest $request): JsonResponse
    {
        $newUser = $this->userService->create(
            name: $request->input('name'),
            email: $request->input('email'),
            password: $request->input('password'),
        );

        return response()->json($newUser, Response::HTTP_CREATED);
    }
}
