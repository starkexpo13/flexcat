<?php

namespace Engine\Service\Router;

use Engine\Service\AbstractProvider;
use Engine\Http\Router\Router;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    public $serviceName = 'router';

    /**
     * @return mixed
     */
    public function init()
    {
        $router = new Router('https://webtester.cc/');

        $this->di->set($this->serviceName, $router);
    }


}