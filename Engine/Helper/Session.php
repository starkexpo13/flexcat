<?php


namespace Engine\Helper;


class Session
{
//    public static function start($param)
//    {
////        session_id($param);
////        if (session_status() === PHP_SESSION_NONE) {
////            session_start(['cookie_lifetime' => 86400]);
////        }
//        session_id($param);
//        session_start(['cookie_lifetime' => 86400]);
//    }

    public static function close()
    {
//        if (session_status() === PHP_SESSION_ACTIVE) {
        session_destroy();
        session_write_close();
        session_unset();
//        }
    }

    /**
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return null;
    }

    /**
     * @param $key
     */
    public static function delete($key)
    {
        // @session_start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}