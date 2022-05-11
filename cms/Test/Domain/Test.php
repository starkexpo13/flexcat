<?php


namespace cms\Test\Domain;


class Test
{
    public function gridFields()
    {
        return [
            'title',
            'kol_quest',
            'time_quest',
            'bally',
            'questrandom',
            'answerrandom',
            'timedo',
            'type_answer',
            'tanswer',
            'access',
            'id'
        ];
    }

    public function getData()
    {
        return [
            ['field' => 'title', 'type' => 'text', 'width' => 'auto'],
            ['field' => 'access', 'type' => 'text', 'width' => '50'],
            ['field' => 'id', 'type' => 'number', 'width' => '30']
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Заголовок',
            'access' => 'Доступ',
            'id' => 'ID'
        ];
    }
}