<?php


namespace admin\Users\Service;


use Engine\Service\Service;

class UsersService extends Service
{
    public function getData()
    {
        $data = $this->getList('onlinetests');

        $testList = [];

        foreach ($data as $item) {
            $testList[$item->id] = $item->title;
        }


        return $testList;
    }
}