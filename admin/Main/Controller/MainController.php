<?php

namespace admin\Main\Controller;


use admin\Auth\Controller\AuthController;
use Engine\Controller\Controller;
use Engine\Auth\Auth;
use Engine\DI\DI;
use Engine\Helper\Cookie;

class MainController extends Controller
{
    /**
     * @var Auth
     */
    protected $auth;
    public $user;
    protected $modelLogin;

    /**
     * MainController constructor.
     * @param $di
     */


    public function __construct(DI $di)
    {
        parent::__construct($di);
        $this->auth = new Auth();
        $this->checkAuthorization();
    }


    /**
     * checkAuthorization
     */
    public function checkAuthorization()
    {
        if ((!isset($this->request->session['authorized']) || $this->request->session['authorized'] !== true || intval($this->request->session['userLevel']) !== 3) &&
            $this->request->server['REQUEST_URI'] !== '/admin/login/' &&
            !isset($this->request->post['authrorizated'])){
            header('Location: ' . \Core_LinkProxy::getLink() . '/admin/login/', true, 301);
            exit;
        }
    }

    public function homePage()
    {
        $this->view->render('Main/home');
    }
}