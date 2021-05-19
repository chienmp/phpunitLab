<?php

namespace App;

use PDO;
use DateTime;
use App\Exception\NotFoundUserException;

class UserRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addUser(string $name, DateTime $birthday): string
    {
        $newUser = [
            'name' => $name,
            'dob'  => $birthday->format("Y-m-d H:i:s")
        ];

        $addUserStatement = $this->pdo->prepare("INSERT INTO user (name, birthday) VALUES (:name, :dob)");
        $isInsertedUser   = $addUserStatement->execute($newUser);
        return "them nguoi dung thanh cong !!";
    }

    public function searchByName(string $name): array
    {
        $filterUserByName          = "SELECT name FROM user WHERE name LIKE '%$name%'";
        $userFilterByNameStatement = $this->pdo->query($filterUserByName);
        $names                     = $userFilterByNameStatement->fetchAll(PDO::FETCH_COLUMN);

        return $names;
    }

    public function updateNameById(int $id, $newProfile = []): array
    {
        $nameUser               = $newProfile['name'];
        $updateNameById         = "UPDATE user set `name` = '$nameUser' WHERE id = $id";

        $numberUserUpdated      = $this->pdo->exec($updateNameById);

        $filterUserById         = "SELECT * FROM user WHERE id = $id";
        $userByIdStatement      = $this->pdo->query($filterUserById);
        $user                   = $userByIdStatement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function deleteUserById(int $id): void
    {
        $deleteUserById  = "DELETE FROM user WHERE id = $id";
        $this->pdo->exec($deleteUserById);
    }

    public function filterUserById(int $id): array
    {
        $filterUserById          = "SELECT * FROM user WHERE id = $id";
        $filterUserByIdStatement = $this->pdo->query($filterUserById);
        $userFound               = $filterUserByIdStatement->fetch(PDO::FETCH_ASSOC);

        return $userFound;
    }

    public function getUserById(int $id): array
    {
        $filterUserById          = "SELECT * FROM user WHERE id = $id";
        $filterUserByIdStatement = $this->pdo->query($filterUserById);
        $userFound               = $filterUserByIdStatement->fetch(PDO::FETCH_ASSOC);
        if(!$userFound){
            return throw new NotFoundUserException("Not found user with id $id", 404);
        }
        return $userFound;
    }
}
