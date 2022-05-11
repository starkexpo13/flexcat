<?php


namespace admin\Questions\Domain;


class Questions
{
    public function gridFields()
    {
        return [
            'id',
            'idtest',
            'title',
            'published',
            'created',
            'modified',
            'image_caption',
            'language'
        ];
    }

    public function getData()
    {
        return [
            ['field' => 'title', 'type' => 'text', 'width' => 'auto'],
            ['field' => 'published', 'type' => 'text', 'width' => '50'],
            ['field' => 'id', 'type' => 'number', 'width' => '30']
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Вопрос',
            'published' => 'Публикация',
            'id' => 'ID'
        ];
    }
}