<?php
$this->router->add('auth-page-form', '/admin/login/', 'AuthController:authPage');
$this->router->add('auth-user-set', '/admin/authorizate/', 'AuthController:logIn', 'POST');
$this->router->add('auth-user-out', '/admin/logout/', 'AuthController:logOut');
$this->router->add('main-homepage', '/admin/', 'AuthController:homePage');