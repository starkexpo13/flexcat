<?php

namespace admin\Auth\Domain;

class Auth
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
            ['field' => 'level', 'type' => 'text', 'width' => '50'],
            ['field' => 'id', 'type' => 'number', 'width' => '30']
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'ФИО',
            'level' => 'Доступ',
            'id' => 'ID'
        ];
    }
}