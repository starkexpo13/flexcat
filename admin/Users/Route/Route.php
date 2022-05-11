<?php
$this->router->add('users-listing', '/admin/users/listing/', 'UsersController:index');
$this->router->add('users-listing-group', '/admin/users/listing/(id:int)', 'UsersController:index');
$this->router->add('users-delete', '/admin/users/delete/(id:int)', 'UsersController:delete');
$this->router->add('users-create', '/admin/users/create/', 'UsersController:create');
$this->router->add('users-edit', '/admin/users/edit/(id:int)', 'UsersController:create');
$this->router->add('Users-updates', '/admin/users/update/', 'UsersController:update', 'POST');
$this->router->add('Users-clear', '/admin/users/clear/(id:int)', 'UsersController:clear');