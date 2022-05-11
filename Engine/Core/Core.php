<?php

namespace Engine\Core;

use Engine\Http\Router\DispatchedRoute;
use Engine\Helper\Common;

class Core
{
    private $di;

    public $router;
    private $listModules;
    private $pathNamespace;
    private $pathFolderRoute;

    function __construct($di)
    {
        $this->di = $di;
        $this->router = $this->di->get('router');
        $this->pathNamespace = 'cms';
        $this->pathFolderRoute = "/Route/Route.php";
        if (strtolower(ENV) == 'admin') {
            $this->pathNamespace = '../' . strtolower(ENV);
        } else {
            $this->pathNamespace =  strtolower(ENV);
        }
        $this->listModules = scandir($this->pathNamespace);
    }

    function run()
    {
        try {
            foreach ($this->listModules as $key => $item) {
                if ($item !== '.' && $item !== '..' && $item !== 'index.php' && $item !== 'Assets' && is_file($this->pathNamespace . "/" . $item) == false) {
                    if (file_exists($this->pathNamespace . "/" . $item . $this->pathFolderRoute) === true) {
                        require_once $this->pathNamespace . "/" . $item . $this->pathFolderRoute;
                    }
                } else {
                    unset($this->listModules[$key]);
                }
            }
            $routerDispatch = $this->router->dispatch(Common::getMethod(), Common::getPatchUrl());

            if ($routerDispatch == null) {
//                $routerDispatch = new DispatchedRoute('ErrorController:page404');
                echo "<h1>Error 404!</h1>";
                exit();
            }

            list($class, $action) = explode(':', $routerDispatch->getController(), 2);

            $folderName = str_replace('Controller', '', $class);
            $controller = '/' . mb_strtolower(ENV) . '/' . $folderName . '/Controller/' . $class;
            $testExist = ROOT_DIR . $controller . '.php';

            if (mb_strtolower(ENV) == 'cms') {
                $testExist = ROOT_DIR . $controller . '.php';
            } elseif (mb_strtolower(ENV) == 'admin') {
                $controller = str_replace('/admin', '', $controller);
                $testExist = ROOT_DIR . $controller . '.php';
            }

            if (file_exists($testExist) === true) {
                $parameters = $routerDispatch->getParameters();
                $controller = str_replace('/', '\\', $controller);
                if (mb_strtolower(ENV) == 'admin') {
                    $controller = "\\" . mb_strtolower(ENV) . $controller;
                }
                call_user_func_array([new $controller($this->di), $action], $parameters);
            }
        } catch
        (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}