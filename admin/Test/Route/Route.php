<?php
$this->router->add('test-listing', '/admin/test/listing/', 'TestController:index');
$this->router->add('test-delete', '/admin/test/delete/(id:int)', 'TestController:delete');
$this->router->add('test-create', '/admin/test/create/', 'TestController:create');
$this->router->add('test-edit', '/admin/test/edit/(id:int)', 'TestController:create');
$this->router->add('test-updates', '/admin/test/update/', 'TestController:update', 'POST');