<?php

namespace App\Domain\User\Repositories;

use Domain\User\Models\User;

class UserRepository
{
    public function createUser(
        string $name,
        string $email,
        string $password,
    ): User
    {
        /** @var User $user */
        $user =  User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        return $user;
    }

    public function findOneBy(array $criteria): ?User
    {
        /** @var User $user */
        $user =  User::query()->where($criteria)->first();
        
        return $user;
    }
}
