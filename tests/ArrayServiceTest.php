<?php

namespace AppTest;

use PHPUnit\Framework\TestCase;
use App\Service\ArrayService;

class ArrayServiceTest extends TestCase
{
    private array $dataInput = [

        [
            'id'   => 1,
            'name' => 'hung1'
        ],
        [
            'id' => 2,
            'name' => 'hung2'
        ],
        [
            'id' => 3,
            'name' => 'hung3'
        ],
        [
            'id' => 4,
            'name' => 'hung4'
        ],
    ];
    public function testGetListIdReturnIdArray(): void
    {
        $expectedIds = [1, 2, 3, 4];
        $array = new ArrayService();
        $actualArrayIds = $array->getListId($this->dataInput);
        $this->assertEquals($expectedIds, $actualArrayIds, 'du lieu tar ve co giong nhau hay khong');
    }

    public function testGetListAssociateIdReturnKeyIdwithValueId(): void
    {
        $expectedIdsHasKey = [
            [
                'id' => 1,
            ],
            [
                'id' => 2,
            ],
            [
                'id' => 3,
            ],
            [
                'id' => 4,
            ]
        ];
        $array = new ArrayService();
        $actualIdsHasKey = $array->getListAssociateId($this->dataInput);
        $this->assertEquals($expectedIdsHasKey, $actualIdsHasKey, 'du lieu tar ve co giong nhau hay khong');
    }

    public function testCreateMapIdToNameReturnAssociateArrayWithKeyIsIdAndValueIsName(): void
    {
        $expectedMap= [
            '1'   => 'hung1',
            '2'   => 'hung2',
            '3'   => 'hung3',
            '4'   => 'hung4',
        ];
        $array = new ArrayService();
        $actualMapIdToName = $array->createMapIdToName($this->dataInput);
        $this->assertEquals($expectedMap, $actualMapIdToName, 'du lieu tar ve co giong nhau hay khong');
    }

    public function testGetListPairIdAndNameReturnArrayWithValueIsIdAndName(): void
    {
        $expectedListIdAndName = [
            '1_hung1',
            '2_hung2',
            '3_hung3',
            '4_hung4',
        ]; 
        $array = new ArrayService();
        $actualListIdAndName = $array->getListPairIdAndName($this->dataInput);
        $this->assertEquals($expectedListIdAndName, $actualListIdAndName, 'du lieu tar ve co giong nhau hay khong');
    }

    public function testCreateMapIdToUserReturnAsocciateArrayWithKeyIsIdAndValueIsUser(): void
    {
        $expectedMapId2User = [
            1 => [
                'id'    =>1,
                'name'  =>'hung1'
            ],
            2 => [
                'id'    =>2,
                'name'  =>'hung2'
            ],
            3 => [
                'id'    =>3,
                'name'  =>'hung3'
            ],
            4 => [
                'id'    =>4,
                'name'  =>'hung4'
            ],
        ]; 
        $array = new ArrayService();
        $actualMapId2User = $array->createMapIdToUser($this->dataInput);
        $user4 = $actualMapId2User[4];
        $this->assertEquals([
            'id'    =>4,
            'name'  =>'hung4'
        ],$user4);
        $this->assertEquals($expectedMapId2User, $actualMapId2User, 'du lieu tar ve co giong nhau hay khong');
    }
}
