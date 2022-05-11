<?php
$data['title'] = 'Тесты | FlexCatCMS';
$this->theme->header('', $data);
$this->theme->block('sidebar');

$form = new \Core_Form([
    'title' => 'Тесты',
    'ownLink' => '/test/',
    'fields' => $interface,
//    'color' => 'red'
]);
$form->description = 'Редактирование теста';
$form->models = $data[0];
$form->render();

$this->theme->footer();