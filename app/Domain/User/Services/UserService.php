<?php

namespace App\Domain\User\Services;

use App\Domain\User\Repositories\UserRepository;
use Domain\User\Models\User;
use Illuminate\Support\Facades\Hash;

readonly class UserService
{
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    public function create(
        string $name,
        string $email,
        string $password,
    ): User
    {
        return $this->userRepository->createUser(
            name: $name,
            email: $email,
            password: Hash::make($password)
        );
    }
}
