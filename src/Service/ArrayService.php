<?php

namespace App\Service;

class ArrayService
{

    public function getListId(array $listUser): array
    {
        $ids = [];
        foreach($listUser as $user)
        {
            $id     = $user['id'];
            $ids[]  = $id;
        }
        return $ids;


        $ids = array_column($listUser, 'id');
        return $ids;

        $ids = [];

        for ($index = 0; $index < count($listUser); $index++) {
            $id = $listUser[$index]['id'];
            $ids[] = $id;
        }

        return $ids;
    }

    public function getListAssociateId(array $listUser): array
    {
        $idHasKey = [];
        foreach($listUser as $user){
            $id = $user['id'];
            $idHasKey[] = [
                'id' => $id
            ];
        }
        return $idHasKey;

        $idHasKey = [];
        for ($index = 0; $index < count($listUser); $index++) {
            $id = $listUser[$index]['id'];
            $idHasKey[] = [
                'id' => $id
            ];
        }

        return $idHasKey;
    }

    public function createMapIdToName(array $listUser): array
    {
        $mapIdToName = [];
        foreach($listUser as $user){
            $id =$user['id'];
            $name =$user['name'];
            $mapIdToName[$id] = $name;
        }
        return $mapIdToName;

        $mapIdToName = [];
        for ($index = 0; $index < count($listUser); $index++) {
            $id = $listUser[$index]['id'];
            $name = $listUser[$index]['name'];
            $mapIdToName[] =  [
                $id =>$name
            ];
        }

        return $mapIdToName;
    }

    public function getListPairIdAndName(array $listUser): array
    {
        $listIdAndName = [];
        foreach($listUser as $user){
            $id               = $user['id'];
            $name             = $user['name'];
            $idAndName        = "{$id}_{$name}";
            $listIdAndName[]  = $idAndName;
        }
        return $listIdAndName;

        $listIdAndName = [];
        for ($index = 0; $index < count($listUser); $index++) {
            $id               = $listUser[$index]['id'];
            $name             = $listUser[$index]['name'];
            $idAndName        = "{$id}_{$name}";
            $listIdAndName[]  = $idAndName;
        }

        return $listIdAndName;
    }

    public function createMapIdToUser(array $listUser) :array 
    {
        $mapIdToUser = [];
        foreach($listUser as $users){
            $id   = $users['id'];
            $name = $users['name'];
            $user = [
                'id'    =>$id,
                'name'  =>$name
            ] ;
            $mapIdToUser[$id] = $user;
        }
        return $mapIdToUser;

        $mapIdToUser = [];
        for ($index = 0; $index < count($listUser); $index++) {
            $id = $listUser[$index]['id'];
            $name = $listUser[$index]['name'];
            $user = [
                'id'    =>$id,
                'name'  =>$name
            ] ;
            $mapIdToUser[$id] = $user;
        }

        return $mapIdToUser;
    }
}


