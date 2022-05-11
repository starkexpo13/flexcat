<?php


namespace Engine\Helper;


use Dotenv\Dotenv;

class GetConfig
{
    public static function getSettings()
    {
        $dotenvLoad = Dotenv::createImmutable($_SERVER["DOCUMENT_ROOT"]);
        $config = $dotenvLoad->load();

        return $config;
    }
}