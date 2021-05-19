<?php

namespace AppTest;

use App\ListObject;
use PHPUnit\Framework\TestCase;

class ListObjectTest extends TestCase
{
    private function getListUser(): array
    {
        return [
            (object)[
                'id' => 'id1',
                'name' => 'hung1'
            ],
            (object)[
                'id' => 'id2',
                'name' => 'hung2'
            ],
            (object)[
                'id' => 'id3',
                'name' => 'hung3'
            ],
            (object)[
                'id' => 'id4',
                'name' => 'hung4'
            ],
        ];    
    }
    
    
    public function testGetListIdReturnArrayIdList() : void
    {
        $expectedIds = ['id1', 'id2', 'id3', 'id4'];
        $userList = new ListObject();
        $actualIds=$userList->getListId($this->getListUser());
        $this->assertEquals($expectedIds,$actualIds);

    }

    public function testCreateMapIdToNameReturnAssociateArrayWithKeyIsIdAndValueIsName(): void
    {
        $expectedMapId2Name = [
            'id1' => 'hung1',
            'id2' => 'hung2',
            'id3' => 'hung3',
            'id4' => 'hung4',
        ];
        $userList = new ListObject();
        $actualMapId2Name=$userList->createMapIdToName($this->getListUser());
        $this->assertEquals($expectedMapId2Name, $actualMapId2Name);
    }

    public function testCreateMapIdToUserReturnAssociateArrayWithKeyIsIdAndValueIsUser(): void
    {
        $expectedMapId2User = [
            'id1' => (object)['id' => 'id1','name' => 'hung1'],
            'id2' => (object)['id' => 'id2','name' => 'hung2'],
            'id3' => (object)['id' => 'id3','name' => 'hung3'],
            'id4' => (object)['id' => 'id4','name' => 'hung4'],
        ];
        $userList = new ListObject();
        $actualMapId2User = $userList->createMapIdToUser($this->getListUser());
        $this->assertEquals($expectedMapId2User, $actualMapId2User);

        
    }
}