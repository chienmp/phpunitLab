<?php

namespace AppTest;

use App\Exception\NotFoundUserException;
use PHPUnit\Framework\TestCase;
use App\Service\GreetingService;
use App\UserRepository;

class GreetingServiceTest extends TestCase
{
    public function testWhenCallHiWithNameThenReturnHiName(): void
    {
        // $pdo = require __DIR__ . "/../config/create-db-pdo-connection.php";
        // $userRepository = new UserRepositoryFake1($pdo);
        $userRepository = $this->createMock(UserRepository::class);

        $greetingService = new GreetingService($userRepository);
        $message = $greetingService->sayHi('hung');
        $this->assertEquals('Hi HUNG', $message, 'Ham nay viet dung chua ?');
    }

    public function testWhenCallSayHiByUserIdThenReturnHiName(): void
    {
        // $pdo = require __DIR__ . "/../config/create-db-pdo-connection.php";
        // $userRepository = new UserRepositoryFake1($pdo);
        $userRepository = $this->createMock(UserRepository::class);
        $foundedUser = [
            "name"=>"hung"
        ];
        $userRepository->method("getUserById")->willReturn($foundedUser);
        $greetingService = new GreetingService($userRepository);
        $message = $greetingService->sayHiByUserId(1);
        $this->assertEquals('Hi HUNG', $message, 'Ham nay viet dung chua ?');
    }

    public function testWhenCallSayHiByUserIdNotExistThenReturnHiAnnonymous(): void
    {
        // $pdo = require __DIR__ . "/../config/create-db-pdo-connection.php";
        // $userRepository = new UserRepositoryNotFound($pdo);
        $userRepository = $this->createMock(UserRepository::class);
        $userRepository->method('getUserById')
            ->willThrowException(new NotFoundUserException(''));

        $greetingService = new GreetingService($userRepository);
        $message = $greetingService->sayHiByUserId(1);
        $this->assertEquals('Hi Annonymous', $message, 'Ham nay viet dung chua ?');
    }
}
