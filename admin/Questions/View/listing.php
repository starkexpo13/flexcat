<?php
$data['title'] = 'Вопросы | FlexCatCMS';
$this->theme->header('', $data);
$this->theme->block('sidebar');

$actions = [
//    ['action' => 'view', 'icon' => 'la-file-text', 'title' => 'Подробнее'],
    ['action' => 'edit', 'icon' => 'fas fa-pencil-alt', 'title' => 'Редактировать',  'class' => 'hasTooltip'],
    ['action' => 'delete', 'icon' => 'fas fa-trash', 'title' => 'Удалить', 'style' => 'color: #FF2C00',  'class' => 'hasTooltip']
];

$domain = new \admin\Questions\Domain\Questions();


$grid = new \Core_DataGrid([
    'headTitles' => $domain->getData(),
    'fields' => $domain->attributes(),
    'ownLink' => '/questions/',
    'title' => 'Вопросы',
    'actions' => $actions,
    'buttons' => 'off',
    'filter' => 'on',
    'filterLink' => '/admin/questions/listing/',
    'filterTitle' => 'Выберите тест',
    'filterDefault' => $id
]);

$dataFilter = [];
foreach ($testList as $item) {
    $dataFilter[$item->id] = $item->title;
}

$grid->description = '<a class="btn btn-success" href="/admin/questions/create"><i class="fa fa-plus"></i> Добавить</a>';
$grid->filterData = $dataFilter;
$grid->models = $data;
$grid->customJS = '<script src="/admin/Assets/dist/js/hasTooltip.js"></script>';
$grid->render();


$this->theme->footer();