<?php
$this->router->add('test-login-page', '/', 'TestController:index');
$this->router->add('test-auth-page', '/login/', 'TestController:logIn', 'POST');
$this->router->add('test-profile-page', '/profile/', 'TestController:profile');
$this->router->add('test-start-page', '/test/', 'TestController:testing');
$this->router->add('test-result-save', '/results/', 'TestController:results', 'POST');
$this->router->add('test-user-logout', '/logout/', 'TestController:logOut');