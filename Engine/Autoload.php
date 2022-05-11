<?php

spl_autoload_register(function ($classname) {

    $classname = str_replace('Admin', "admin", $classname);
    $classname = str_replace('adminController', "MainController", $classname);
    $classname = str_replace('\\', '/', $classname);

    require_once($_SERVER['DOCUMENT_ROOT'] . "/$classname.php");
});