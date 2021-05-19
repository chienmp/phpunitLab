<?php

namespace App\Service;

use App\Exception\NotFoundUserException;
use App\UserRepository;

class GreetingService 
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository ;
    }

    public function sayHi(string $name) : string
    {
        $name = strtoupper($name);
        return "Hi $name";
    }

    public function sayHiByUserId(int $id) : string
    {
        try {
            $user = $this->userRepository->getUserById($id);
            $name = $user['name'] ?? '';
            $name = strtoupper($name);
        } catch (NotFoundUserException $e) {
            $name = 'Annonymous';
        }
        
        return "Hi $name";
    }
}