<?php

namespace AppTest;

use App\UserRepository;
use App\Exception\NotFoundUserException;

class UserRepositoryNotFound extends UserRepository
{
    public function getUserById(int $id): array
    {
        throw new NotFoundUserException("Not found user with id $id");
    }
}
