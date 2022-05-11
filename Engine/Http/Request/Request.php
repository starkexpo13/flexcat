<?php


namespace Engine\Http\Request;


class Request
{
    /**
     * @var array
     */
    public $get = [];

    /**
     * @var array
     */
    public $post = [];

    /**
     * @var array
     */
    public $request = [];

    /**
     * @var array
     */
    public $cookie = [];

    /**
     * @var array
     */
    public $files = [];

    /**
     * @var array
     */
    public $server = [];

    /**
     * @var array
     */
    public $session = [];

    /**
     * Request constructor.
     */
    public function __construct()
    {
        session_start(['cookie_lifetime' => 86400]);
        $this->get = $_GET;
        $this->post = $_POST;
        $this->request = $_REQUEST;
        $this->cookie = $_COOKIE;
        $this->files = $_FILES;
        $this->server = $_SERVER;
        $this->session = $_SESSION;
    }
}