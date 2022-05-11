<?php


namespace admin\Questions\Controller;


use admin\Main\Controller\MainController;

class QuestionsController extends MainController
{
    public function index($id = '')
    {
        $query['testList'] = $this->load->model('Test')->repository->getList();

        if (strlen($id) <= 0) {
            $id = $query['testList'][0]->id;
        }

        $query['data'] = $this->loadModel->repository->getList('idtest:' . $id);
        $query['id'] = $id;

        $this->view->render($this->class . '/listing', $query);
    }

    public function create($id = '')
    {
        if (strlen($id) > 0 && intval($id) <> 0) {
            $query['data'] = $this->loadModel->repository->getList('id:' . $id);
            $query['answers'] = $this->loadModel->repository->getAnswersList($query['data'][0]->id);
        }
        $query['interface'] = $this->form->getinterface();

        $this->view->render($this->class . '/form', $query);
    }

    public function update()
    {
        $data = [];
        foreach ($this->request->post as $key => $item) {
            if ($key !== "answer" && $item !== "" && $key !== "trues") {
                $data[$key] = $item;
            }
        }
        if (intval($this->request->post['id']) <= 0) {
            $lastID = $this->loadModel->repository->createQeustions($data);

            foreach ($this->request->post['answer'] as $key => $item) {
                if ($this->request->post['trues'] == $key) {
                    $trues = 1;
                } else {
                    $trues = 0;
                }
                $this->loadModel->repository->createAnswers($lastID, $item, $trues);
            }
        } else {
            foreach ($this->request->post['answer'] as $key => $item) {
                $resultFind = $this->loadModel->repository->findAnswerBase($data['id'], $key);
                if ($key == intval($this->request->post['trues'])) {
                    $trues = 1;
                } else {
                    $trues = 0;
                }

                if (intval($resultFind) > 0) {
                    $this->loadModel->repository->updateAnswers($data['id'], $item, $trues, $key);
                } else {
                    $this->loadModel->repository->createAnswers($data['id'], $item, $trues);
                }
            }
        }
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    }

    public function deleteAnswer($id)
    {
        $id = intval(trim(htmlspecialchars(stripcslashes($id))));

        $this->loadModel->repository->deleteAnswer($id);

        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    }
}