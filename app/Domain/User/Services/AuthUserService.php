<?php

namespace App\Domain\User\Services;

use App\Domain\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

readonly class AuthUserService
{
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    public function login(
        string $email,
        string $password
    ): NewAccessToken
    {
        $user = $this->userRepository->findOneBy([
            'email' => $email,
        ]);

        if (!$user || !Hash::check($password, $user->password)) {
            throw new UnauthorizedHttpException('Bearer ', 'Invalid credentials');
        }

        return $user->createToken(
            'auth-login',
            ['*'],
            now()->addMinutes(15)
        );
    }
}
