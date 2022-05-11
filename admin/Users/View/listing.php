<?php
$data['title'] = 'Пользователи | FlexCatCMS';
$this->theme->header('', $data);
$this->theme->block('sidebar');

$actions = [
    [
        'action' => 'clear',
        'icon' => 'fas fa-eraser',
        'title' => 'Очистить тест',
        'class' => 'hasTooltip',
        'style' => 'color: #E52B50',
    ],
    [
        'action' => 'edit',
        'icon' => 'fas fa-pencil-alt',
        'title' => 'Редактировать',
        'class' => 'hasTooltip'
    ],
    [
        'action' => 'delete',
        'icon' => 'fas fa-trash',
        'title' => 'Удалить',
        'style' => 'color: #FF2C00',
        'class' => 'hasTooltip'
    ]
];

$domain = new \admin\Users\Domain\Users();
$grid = new \Core_DataGrid([
    'headTitles' => $domain->getData(),
    'fields' => $domain->attributes(),
    'ownLink' => '/users/',
    'title' => 'Пользователи',
    'actions' => $actions,
    'buttons' => 'off',
    'filter' => 'on',
    'filterLink' => '/admin/users/listing/',
    'filterTitle' => 'Выберите группу',
    'filterDefault' => $id
]);

$dataFilter = [
    1 => "Пользователи тестирования",
    3 => "Администраторы"
];
foreach ($usersList as $key => $item) {
    if (intval($item->level) == 3) {
        $level = 'Администратор';
    } else {
        $level = 'Пользователь';
    }
    $usersList[$key]->level = $level;

    if (intval($item->block) == 0) {
        $block = '<i class="fa fa-user-check text-success hasTooltip" title="Открыт доступ"></i>';
    } else {
        $block = '<i class="fa fa-user-lock text-danger hasTooltip" title="Закрыт доступ"></i>';
    }
    $usersList[$key]->block = $block;

    if (intval($item->testingstatus) <= 0) {
        $testStatus = '<i class="fa fa-clock text-info hasTooltip" title="В ожидании"></i>';
    } else {
        $testStatus = '<i class="fa fa-check-circle text-success hasTooltip" title="Тест пройден"></i>';
    }
    $usersList[$key]->testingstatus = $testStatus;
}


$grid->description = '<a class="btn btn-success" href="/admin/users/create/"><i class="fa fa-plus"></i> Добавить</a>';
$grid->filterData = $dataFilter;
$grid->models = $usersList;
$grid->customJS = '<script src="/admin/Assets/dist/js/hasTooltip.js"></script>';
$grid->render();





$this->theme->footer();