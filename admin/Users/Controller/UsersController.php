<?php


namespace admin\Users\Controller;


use admin\Main\Controller\MainController;

class UsersController extends MainController
{
    public function index($id = '')
    {
        if (!isset($id) || intval($id) <= 0) {
            $id = 1;
        }
        $id = intval(trim(htmlspecialchars(stripcslashes($id))));

        $query['id'] = $id;
        $query['usersList'] = $this->loadModel->repository->getList("level:".$id);

        $this->view->render($this->class . '/listing', $query);
    }

    public function create($id = '')
    {
        $id = intval(trim(htmlspecialchars(stripcslashes($id))));

        if (strlen($id) > 0 && intval($id) <> 0) {
            $query['data'] = $this->loadModel->repository->getList('id:' . $id);
        }
        $query['testOptions'] = $this->load->model('Test')->repository->getList("id:". $query['data'][0]->groups)[0];
        $query['results'] = $this->loadModel->repository->getResult($id);
        $query['interface'] = $this->form->getinterface();

        $this->view->render($this->class . '/form', $query);
    }

    public function clear($id)
    {
        $id = intval(trim(htmlspecialchars(stripcslashes($id))));

        if (isset($id) && !empty($id) && $id > 0) {
            $this->loadModel->repository->clear($id);
        }

        \Core_Redirect::reload('/'. mb_strtolower(ENV).'/'. mb_strtolower($this->class).'/listing/');
    }


    public function update()
    {
        if (isset($this->request->post['password']) && strlen($this->request->post['password']) > 1) {
            $password = trim(htmlspecialchars($this->request->post['password']));
            $password = md5($password);
            $this->request->post['password'] = $password;
        } else {
            unset($this->request->post['password']);
        }

        if (isset($this->request->post['id']) && intval($this->request->post['id']) <> 0) {
            $this->loadModel->repository->update($this->request->post);
        } else {
            $id = $this->loadModel->repository->create($this->request->post);
        }

        \Core_Redirect::reload('/'. mb_strtolower(ENV).'/'. mb_strtolower($this->class).'/listing/');
    }
}