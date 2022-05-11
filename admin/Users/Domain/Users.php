<?php


namespace admin\Users\Domain;


class Users
{
    public function gridFields()
    {
        return [
            'testingstatus',
            'image_caption',
            'datetest',
            'testinguser',
            'result',
            'other',
            'adress',
            'phone',
            'groups',
            'level',
            'activation',
            'lastvisitDate',
            'registerDate',
            'sendEmail',
            'block',
            'password',
            'email',
            'username',
            'name',
            'id'
        ];
    }

    public function getData()
    {
        return [
            ['field' => 'name', 'type' => 'text', 'width' => 'auto'],
            ['field' => 'username', 'type' => 'text', 'width' => 'auto'],
            ['field' => 'result', 'type' => 'text', 'width' => '30'],
            ['field' => 'level', 'type' => 'text', 'width' => '80'],
            ['field' => 'block', 'type' => 'text', 'width' => '30'],
            ['field' => 'testingstatus', 'type' => 'text', 'width' => '30'],
            ['field' => 'id', 'type' => 'number', 'width' => '30']
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'ФИО',
            'username' => 'ИИН',
            'result' => 'Баллы',
            'testingstatus' => 'Тест',
            'level' => 'Роль',
            'block' => 'Доступ',
            'id' => 'ID'
        ];
    }
}