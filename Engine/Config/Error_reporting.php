<?php

use Dotenv\Dotenv;

$dotenvLoad = Dotenv::createImmutable($_SERVER["DOCUMENT_ROOT"]);
$config = $dotenvLoad->load();

setlocale(LC_ALL, "'" .  $config['LC_ALL'] . "'");
ini_set('error_reporting',  $config['ERROR_REPORTING_DISPLAY']);
ini_set('display_errors',  $config['DISPLAY_ERRORS']);
ini_set("max_execution_time", $config['MAX_EXECUTION_TIME']);


error_reporting($config['ERROR_REPORTING']);
ini_set('display_errors', $config['DISPLAY_ERRORS_STRICT']);


