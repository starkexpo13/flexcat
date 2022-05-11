<?php


namespace admin\Auth\Controller;


use admin\Main\Controller\MainController;

class AuthController extends MainController
{
    public function logIn()
    {
        $login = trim(htmlspecialchars(stripcslashes($this->request->post['login'])));
        $password = trim(htmlspecialchars(stripcslashes($this->request->post['password'])));
        $password = md5($password);

        $data = $this->load->model('Auth')->repository->getUser($login, $password)[0];

        if (isset($data->username) && isset($data->password)) {
            if (intval($data->activation) !== 1) {
                $error['message'] = "Ваша учетная запись заблокирована!";
                $this->view->render('Auth/loockscreen', $error);
                exit();
            }
            if (intval($data->level) !== 3) {
                $error['message'] = "У Вас нет доступа к данной странице!";
                $this->view->render('Auth/loockscreen', $error);
                exit();
            }

            $this->user = $data;
            $token = base64_encode($data->username . $data->id);
            $this->auth->authorize($token, $data->username, $data->id, $data->level);
        } else {
            $error['message'] = "Неверный логин и пароль";
            $this->view->render('Auth/loockscreen', $error);
            exit();
        }

        \Core_Redirect::reload('/' . mb_strtolower(ENV) . '/');
    }

    public function logOut()
    {
        $this->auth->unAuthorize();
        header('Location: ' . \Core_LinkProxy::getLink() . '/admin/login/', true, 301);
        exit;
    }

    public function authPage()
    {
        if ((!isset($this->request->session['authorized']) || $this->request->session['authorized'] !== true)) {
            $this->view->render('Auth/login');
        }
    }

    public function error303page()
    {
        echo "<h1>EROR 303!</h1>";
        exit();
    }

    private function lockScreen()
    {
        $data['message'] = 'Неверный логин или пароль';
        $this->view->render($this->class . '/loockscreen', $data);
        exit();
    }

}