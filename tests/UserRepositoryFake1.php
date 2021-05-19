<?php

namespace AppTest;

use App\UserRepository;

class UserRepositoryFake1 extends UserRepository
{
    public function getUserById(int $id): array
    {
        return [
            'name' => "hung"
        ];
    }
}
