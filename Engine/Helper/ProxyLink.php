<?php


namespace Engine\Helper;

use Dotenv\Dotenv;

class ProxyLink
{
    public static function getLink()
    {
        $dotenvLoad = Dotenv::createImmutable($_SERVER["DOCUMENT_ROOT"]);
        $config = $dotenvLoad->load();

        return $config['PROXY_LINK'];
    }

    public static function getLinkFavicon()
    {
        $dotenvLoad = Dotenv::createImmutable($_SERVER["DOCUMENT_ROOT"]);
        $config = $dotenvLoad->load();

        return $config['LINK_FAVICON'];
    }
}