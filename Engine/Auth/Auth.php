<?php


namespace Engine\Auth;

use Engine\Helper\Cookie;
use Engine\Helper\Session;

class Auth implements AuthInterface
{
    protected $authorized = false;
    protected $hash_user;
    protected $id;
    protected $user;

    /**
     * @return bool
     */
    public function authorized()
    {
        return $this->authorized;
    }


    /**
     * @return mixed|null
     */
    public function hashUser()
    {
        return Session::get('auth_user');
    }


    /**
     * @param $token
     * @param $login
     * @param $userID
     * @param $userLevel
     */
    public function authorize($token, $login, $userID, $userLevel)
    {
        Session::set('authorized', true);
        Session::set('token', $token);
        Session::set('auth_user', $login);
        Session::set('userID', $userID);
        Session::set('userLevel', $userLevel);
        $this->authorized = true;
    }

    /**
     *
     */
    public function unAuthorize()
    {
        Session::delete('authorized');
        Session::delete('token');
        Session::delete('auth_user');
        Session::delete('userID');
        Session::delete('userLevel');
        Session::close();
        $this->authorized = false;
        $this->user = null;
    }

    /**
     * @return string
     */
    public static function salt()
    {
        return (string)rand(10000000, 99999999);
    }


    /**
     * @param $password
     * @param string $salt
     * @return false|string
     */
    public static function encryptPassword($password, $salt = '')
    {
        return hash('sha256', $password . $salt);
    }
}