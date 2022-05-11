<?php

namespace Engine\Service\SimpleXLSX;

use Engine\Helper\SimpleXLSX;
use Engine\Service\AbstractProvider;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    public $serviceName = 'SimpleXLSX';

    /**
     * @return mixed
     */
    public function init()
    {
        $SimpleXLSX = new SimpleXLSX();

        $this->di->set($this->serviceName, $SimpleXLSX);
    }


}