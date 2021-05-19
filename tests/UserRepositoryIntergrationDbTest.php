<?php

namespace AppTest;

use PHPUnit\Framework\TestCase;
use App\UserRepository;
use DateTime;
use PDO;
use App\GoogleApi;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Argument;
use App\Exception\NotFoundUserException;

class UserRepositoryIntergrationDbTest extends TestCase
{
    use ProphecyTrait;
    private $userReposity;
    private $pdo;
    
    protected function setUp(): void
    {   
        $pdo = require __DIR__."/../config/create-db-pdo-connection.php";
        $pdo->exec("TRUNCATE TABLE user;");
            
        $this->userReposity = new UserRepository($pdo);
        $this->pdo          = $pdo;
    }
    public function testWhenAddValidUserThenNewUserInsertedIntoDatabase(): void
    {
        
        $message      = $this->userReposity->addUser($name='hung', $birthday=new DateTime());
        $listUsers    = $this->pdo->query("SELECT * FROM user")->fetchAll(PDO::FETCH_ASSOC);      
        $expectedListUser = [
            [
                'id'        => 1,
                'name'      => "$name",
                'birthday'  => $birthday->format('Y-m-d H:i:s')
            ]
        ];
        $this->assertEquals($expectedListUser, $listUsers, 'Co tren dung thong tin user hay khong?');
        $this->assertEquals('them nguoi dung thanh cong !!',  $message);
        
    }

    public function testSearchUserByNameWillReturnNonEmptyListUser(): void
    {
        $this->userReposity->addUser($name='nam nguyen', $birthday=new DateTime());
        $this->userReposity->addUser($name1='hung trinh', $birthday1=new DateTime());
        $this->userReposity->addUser($name2='hung nguyen', $birthday2=new DateTime());

        $expectedListUserFound = [$name1, $name2];
        $names                 = $this->userReposity->searchByName('hung');
        $this->assertIsArray($names);
        $this->assertEquals($expectedListUserFound, $names, 'co phai ten la hung khong ?');
        // $this->assertTrue(count($listUser)>0, "Is non empty list user?");
    }
    
    public function testUpdateNameByIdReturnNewNameProfileUpdated(): void
    {   
        $idUser     = 1 ;
        $name       ='nam nguyen';
        $birthday   =new DateTime();
        $this->userReposity->addUser($name, $birthday);
        
        $resultLastUpdate = $this->userReposity->updateNameById($idUser, $newUserName=[
            'name' => 'hung trinh'
        ]);
      
        $expectedUser = [
            'id'        => $idUser,
            'name'      => 'hung trinh',
            'birthday'  => $birthday->format('Y-m-d H:i:s')
        ];

        $this->assertEquals($expectedUser, $resultLastUpdate, 'May dung roi day!');
    }

    public function testDeleteUserByIdReturnEmptyArray(): void

    {
        $id         = 1 ;
        $name       = 'nam nguyen';
        $birthday   = new DateTime();
        $this->userReposity->addUser($name, $birthday);
        $this->userReposity->deleteUserById($id);
        $numberUsers  = $this->pdo->query("SELECT COUNT(*) FROM user")->fetchColumn();      

        $this->assertEquals(0, $numberUsers, 'Ban chua xoa duoc!');
    }

    public function testFindUserByIdReturnUser() : void
    {
        $this->userReposity->addUser($name='nam nguyen', $birthday=new DateTime());
        $this->userReposity->addUser($name1='hung trinh', $birthday1=new DateTime());
        $this->userReposity->addUser($name2='hung nguyen', $birthday2=new DateTime());
        $id = 2;
        $expectedUser = [
            'id'        => $id,
            'name'      => $name1,
            'birthday'  => $birthday1->format('Y-m-d H:i:s')
        ];
        $names                 = $this->userReposity->filterUserById($id);
        $this->assertEquals($expectedUser, $names, 'nguoi dung nay co ton tai khong ?');
    }

    public function testWhenGetUserByExistedIdThenReturnUserFounded() : void
    {
        $this->userReposity->addUser($name='nam nguyen', $birthday=new DateTime());
        $id = 1;
        $expectedUser = [
            'id'        => $id,
            'name'      => $name,
            'birthday'  => $birthday->format('Y-m-d H:i:s')
        ];
        $names = $this->userReposity->getUserById($id);
        $this->assertEquals($expectedUser, $names, 'Ban nhap dung du lieu chua?!!');
    }

    public function testWhenGetUserByNotExistIdThenThrowException() : void
    {
        $userIdNotExist = 1;
        
        $this->expectException(NotFoundUserException::class);
        $notFoundUserException = new NotFoundUserException("khong ton tai hh",404);
        $this->userReposity->getUserById($userIdNotExist);
    }
}
