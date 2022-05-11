<?php


namespace admin\Questions\Form;


use Engine\DI\DI;
use Engine\Form\BuilderInterface;

class QuestionsFormType extends BuilderInterface
{
    public function buildForm()
    {
        $test = $this->service->getData();

        $this->add('idtest', $this->selectType, [
            'label' => 'Тест',
            'value' => $test
        ]);

        $this->add('title', $this->textType, [
            'label' => 'Вопрос'
        ]);

        $this->add('published', $this->selectType, [
            'label' => 'Статус публикации',
            'default' => 1,
            'value' => [
                0 => 'Снят с публикации',
                1 => 'Опубликован'
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