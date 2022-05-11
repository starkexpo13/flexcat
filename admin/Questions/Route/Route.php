<?php
$this->router->add('questions-listing', '/admin/questions/listing/', 'QuestionsController:index');
$this->router->add('questions-listing-id', '/admin/questions/listing/(id:int)', 'QuestionsController:index');
$this->router->add('questions-delete', '/admin/questions/delete/(id:int)', 'QuestionsController:delete');
$this->router->add('questions-create', '/admin/questions/create', 'QuestionsController:create');
$this->router->add('questions-edit', '/admin/questions/edit/(id:int)', 'QuestionsController:create');
$this->router->add('questions-updates', '/admin/questions/update/', 'QuestionsController:update', 'POST');
$this->router->add('questions-answer-delete', '/admin/questions/answer/delete/(id:int)', 'QuestionsController:deleteAnswer');