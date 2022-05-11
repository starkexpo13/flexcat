<?php


namespace admin\Test\Controller;


use admin\Main\Controller\MainController;

class TestController extends MainController
{

    public function index()
    {
        $query['data'] = $this->loadModel->repository->getList();

        $this->view->render($this->class . '/listing', $query);
    }


    public function create($id = '')
    {
        if (strlen($id) > 0 && intval($id) <> 0) {
            $query['data'] = $this->loadModel->repository->getList('id:' . $id);
        }

        $query['interface'] = $this->form->getinterface();

        $this->view->render($this->class . '/form', $query);
    }
}