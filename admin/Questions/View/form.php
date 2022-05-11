<?php
$data['title'] = 'Вопросы | FlexCatCMS';
$this->theme->header('', $data);
$this->theme->block('sidebar');


//echo "<pre>";
//var_dump($answers);

$htmlAnswers = '<br><a href="#" class="text" id="adds_answer">Добавить еще ответ</a><br><br>';

if (count($answers) > 0) {
    foreach ($answers as $key => $item) {
        $key = $key + 1;

        if ($item->trues == '1') {
           $checked = ' checked';
        } else {
            $checked = '';
        }

        $htmlAnswers .= '<div class="form-group ml-4 blockQuestion">';
        $htmlAnswers .= '<input type="radio" name="trues" class="anstrue hasTooltip mr-1 " data-original-title="<strong>Отметьте  правельный вариант ответа   </strong><br />" value="'.$item->id.'" '.$checked.'>';
        $htmlAnswers .= '<label for="answer['. $key .']_id">Ответ '. $key .'</label>';
        $htmlAnswers .= '<a href="/admin/questions/answer/delete/'.$item->id.'" class="text-danger ml-3 fs-3 hasTooltip" data-original-title="<strong>Удалить</strong>"><i class="fa fa-window-close"></i></a>';
        $htmlAnswers .= '<div class="form-group"><input type="text" name="answer['. $item->id .']" id="answer['. $key .']_id" value="' . $item->title . '" class="form-control"></div>';
        $htmlAnswers .= '</div>';
    }
} else {
    $htmlAnswers .= '<div class="form-group ml-4 blockQuestion">';
    $htmlAnswers .= '<input type="radio" name="trues" class="form-check-input anstrue hasTooltip mr-1" data-original-title="<strong>Отметьте  правельный вариант ответа   </strong><br />" value="1">';
    $htmlAnswers .= '<label for="answer[1]_id">Ответ 1</label>';
    $htmlAnswers .= '<div class="form-group"><input type="text" name="answer[1]" id="answer[1]_id" class="form-control"></div>';
    $htmlAnswers .= '</div>';
}


$form = new \Core_Form([
    'title' => 'Вопросы',
    'ownLink' => '/questions/',
    'fields' => $interface,
//    'color' => 'red'
]);
$form->description = 'Редактирование вопроса';
$form->models = $data[0];
$form->customForm .= $htmlAnswers;
$form->customJS = ' <script src="/admin/Assets/dist/js/hasTooltip.js"></script><script src="/admin/Assets/dist/js/category_create.js"></script>';
$form->render();


$this->theme->footer();