<?php

namespace Engine\Service\Config;

use Dotenv\Dotenv;
use Engine\Service\AbstractProvider;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    public $serviceName = 'config';

    /**
     * @return mixed
     */
    public function init()
    {
        $dotenvLoad = Dotenv::createImmutable($_SERVER["DOCUMENT_ROOT"]);
        $config = $dotenvLoad->load();

        $this->di->set($this->serviceName, $config);
    }


}