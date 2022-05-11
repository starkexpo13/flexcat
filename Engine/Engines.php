<?php

require_once __DIR__ . "/Autoload.php";
require_once __DIR__ . "/Config/Alias.php";
require_once __DIR__ . "/Config/Error_reporting.php";

use \Engine\Core\Core;
use \Engine\DI\DI;

try {
    $di = new DI();
    $services = require __DIR__ . "/Config/Service.php";

//    Init Service
    foreach ($services as $service) {
        $provider = new $service($di);
        $provider->init();
    }

    $cms = new Core($di);
    $cms->run();

} catch (\ErrorException $e) {
    echo $e->getMessage();
};



