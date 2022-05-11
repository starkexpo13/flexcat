<?php
$data['title'] = 'Тесты | FlexCatCMS';
$this->theme->header('', $data);
$this->theme->block('sidebar');

$actions = [
//    ['action' => 'view', 'icon' => 'la-file-text', 'title' => 'Подробнее'],
    ['action' => 'edit', 'icon' => 'fas fa-pencil-alt', 'title' => 'Редактировать', 'class' => 'hasTooltip'],
    ['action' => 'delete', 'icon' => 'fas fa-trash', 'title' => 'Удалить', 'style' => 'color: #FF2C00', 'class' => 'hasTooltip']
];

$domain = new \admin\Test\Domain\Test();

$grid = new \Core_DataGrid([
    'headTitles' => $domain->getData(),
    'fields' => $domain->attributes(),
    'ownLink' => '/test/',
    'title' => 'Тесты',
    'actions' => $actions,
    'buttons' => 'off'
]);


foreach ($data as $key => $item) {
    if (intval($item->access) <= 0) {
        $data[$key]->access = 'закрыт';
    } else {
        $data[$key]->access = 'открыт';
    }
}



$grid->description = '<a class="btn btn-success" href="/admin/test/create/"><i class="fa fa-plus"></i> Добавить</a>';
$grid->models = $data;
$grid->customJS = '<script src="/admin/Assets/dist/js/hasTooltip.js"></script>';
$grid->render();

$this->theme->footer();
