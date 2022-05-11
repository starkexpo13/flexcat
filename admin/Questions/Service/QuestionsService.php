<?php


namespace admin\Questions\Service;



use admin\Questions\Domain\Questions;
use Engine\Service\Service;

class QuestionsService extends Service
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