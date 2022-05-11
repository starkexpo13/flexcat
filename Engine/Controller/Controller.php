<?php

namespace Engine\Controller;

use Engine\DI\DI;

abstract class Controller
{
    /**
     * @var DI
     */
    protected $di;
    protected $db;
    protected $view;
    protected $config;
    protected $request;
    protected $load;
    protected $SimpleXLSX;

    protected $getClass;
    protected $classNameSpace;
    protected $class;
    protected $loadModel;
    protected $interface;
    protected $form;
    protected $loadService = '';

    /**
     * Controller constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
        $this->db = $this->di->get('db');
        $this->view = $this->di->get('view');
        $this->config = $this->di->get('config');
        $this->request = $this->di->get('request');
        $this->load = $this->di->get('load');
        $this->SimpleXLSX = $this->di->get('SimpleXLSX');

        $this->getClass = get_class($this);
        $this->class = \Core_GetNameClass::class_basename($this->getClass);
        $this->class = str_replace('Controller', '', $this->class);
        $this->loadModel = $this->load->model($this->class);
        $getClassService = "\\" . str_replace('Controller', 'Service', $this->getClass);
        $this->classNameSpace = "\\" . str_replace('Controller', 'Form', $this->getClass) . "Type";

        $pathExistFileService = $_SERVER['DOCUMENT_ROOT'] . $getClassService  . ".php";
        $testPathExistFileService = str_replace('\\', '/', $pathExistFileService);
        $formBuildPatch = $_SERVER['DOCUMENT_ROOT'] . $this->classNameSpace  . ".php";
        $testFormBuildPatch = str_replace('\\', '/', $formBuildPatch);

        if (file_exists($testPathExistFileService) === true) {
            $this->loadService = new $getClassService($this->di);
        }
        if (file_exists($testFormBuildPatch) === true) {
            $this->form = new $this->classNameSpace($this->loadService);
            $this->form->buildForm();
        }
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $id = intval(trim(htmlspecialchars(stripcslashes($id))));

        if (isset($id) && !empty($id) && $id > 0) {
            $this->loadModel->repository->delete($id);
        }

        \Core_Redirect::reload('/'. mb_strtolower(ENV).'/'. mb_strtolower($this->class).'/listing/');
    }

    /**
     * update data
     */
    public function update()
    {
        if (isset($this->request->post['id']) && intval($this->request->post['id']) <> 0) {
            $this->loadModel->repository->update($this->request->post);
        } else {
            $id = $this->loadModel->repository->create($this->request->post);
        }

        \Core_Redirect::reload('/'. mb_strtolower(ENV).'/'. mb_strtolower($this->class).'/listing/');
    }
}