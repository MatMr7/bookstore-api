<?php

namespace App\Http\Controllers;

use App\Domain\User\Services\AuthUserService;
use App\Http\Requests\Auth\LogInRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthUserService $authUserService
    )
    {
    }

    public function logIn(LogInRequest $request): JsonResponse
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $token = $this->authUserService->logIn($email, $password);

        return response()->json([
            'token' => $token->plainTextToken,
            'expires_at' => $token->accessToken->expires_at
        ]);
    }

    public function logOut(): JsonResponse
    {
        request()->user()->tokens()->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
