<?php

namespace App;

class ListObject
{
    public function getListId(array $listUser): array
    {
        $getUserId = fn($user) => $user->id;
        return array_map($getUserId, $listUser);

        $ids = [];
        foreach ($listUser as $user) {
            $ids[] = $user->id;
        }
        return $ids;
    }

    public function createMapIdToName(array $listUser): array 
    {
        $mapIdToName = function($memo, $user) {
            $id     = $user->id;
            $name   = $user->name;
            $memo[$id] = $name;
            return $memo;
        };

        $memo = [];
        return array_reduce($listUser, $mapIdToName, $memo);

        $idMapToName = [];
        foreach($listUser as $user){
            $id = $user->id;
            $name = $user->name;
            $idMapToName[$id] = $name; 
        }
        return $idMapToName;
    }

    public function createMapIdToUser(array $listUser): array
    {
        $idMapToUser = function($memo, $user){
            $id = $user->id;
            $memo[$id] = $user;
            return $memo;
        };
        $memo = [];
        return array_reduce($listUser, $idMapToUser, $memo);
        $idMapToUser = [];
        foreach($listUser as $user){
            $id = $user->id;
            $idMapToUser[$id] = $user; 
        }
        return $idMapToUser;
    }
}
