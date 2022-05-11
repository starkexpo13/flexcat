<?php


namespace admin\Test\Form;

use Engine\Form\BuilderInterface;

class TestFormType extends BuilderInterface
{
    public function buildForm()
    {
        $this->add('title', $this->textType, [
            'label' => 'Название теста'
        ]);
        $this->add('kol_quest', $this->textType, [
            'label' => 'Вопросов для пользователя',
            'description' => 'Введите колличество вопросов, которое увидит пользователь в тесте',
            'numericOnly' => true
        ]);
        $this->add('time_quest', $this->textType, [
            'label' => 'Время теста',
            'placeholder' => 'в минутах',
            'numericOnly' => true
        ]);
        $this->add('bally', $this->textType, [
            'label' => 'Проходные баллы',
            'description' => 'Введите колличество баллов, для зачета теста',
            'numericOnly' => true
        ]);
        $this->add('questrandom', $this->hidden, [
            'value' => '0'
        ]);
        $this->add('questrandom', $this->switchType, [
            'label' => 'Перемешать вопросы (в разброс отображение вопросов)'
        ]);
        $this->add('answerrandom', $this->hidden, [
            'value' => '0'
        ]);
        $this->add('answerrandom', $this->switchType, [
            'label' => 'Перемешать ответы (в разброс отображение ответов)',
        ]);
        $this->add('timedo', $this->hidden, [
            'value' => '0'
        ]);
        $this->add('timedo', $this->switchType, [
            'label' => 'Завершить до окончания (Возможность завершить тестирование, до окончания времени)',
        ]);
        $this->add('tanswer', $this->selectType, [
            'label' => 'Маркировка вариантов ответов',
            'value' => [
                1 => 'Буквы английские',
                2 => 'Цифры'
            ]
        ]);
        $this->add('language', $this->selectType, [
            'label' => 'Язык интерфейса',
            'value' => [
                'ru' => 'На русском',
                'kz' => 'На казахском'
            ]
        ]);
        $this->add('access', $this->selectType, [
            'label' => 'Доступ',
            'default' => 1,
            'value' => [
                0 => 'Закрыт',
                1 => 'Открыт'
            ]
        ]);
        $this->add('id', $this->textType, [
            'label' => 'ID (не заполняется)',
            'readonly' => true
        ]);
        $this->add('save', $this->submit, [
            'label' => 'Сохранить',
            'color' => 'green'
        ]);
        $this->add('reset', $this->reset, [
            'label' => 'Сбросить'
        ]);
    }
}