<?php


namespace admin\Users\Form;


use Engine\Form\BuilderInterface;

class UsersFormType extends BuilderInterface
{
    public function buildForm()
    {
        $test = $this->service->getData();

        $this->add('name', $this->textType, [
            'label' => 'ФИО'
        ]);

        $this->add('username', $this->textType, [
            'label' => 'ИИН',
//            'numericOnly' => true,
            'required' => true
        ]);

        $this->add('password', $this->textType, [
            'label' => 'Пароль от 6 до 16 символов'
        ]);

        $this->add('groups', $this->selectType, [
            'label' => 'Назначить тест',
            'value' => $test
        ]);

        $this->add('other', $this->textType, [
            'label' => 'Дату рождения',
            'placeholder' => '01-01-1999',
        ]);
        $this->add('email', $this->textType, [
            'label' => 'E-mail',
        ]);

        $this->add('level', $this->selectType, [
            'label' => 'Роль',
            'value' => [
                1 => 'Пользователь',
                3 => 'Администратор'
            ]
        ]);

        $this->add('block', $this->selectType, [
            'label' => 'Доступ',
            'default' => 0,
            'value' => [
                0 => 'Открыт',
                1 => 'Закрыт'
            ]
        ]);

        $this->add('activation', $this->hidden, [
            'value' => 1
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