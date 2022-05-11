<?php


namespace Engine\Auth;


interface AuthInterface
{
    /**
     * @return mixed
     */
    public function authorized();

    /**
     * @return mixed
     */
    public function unAuthorize();
}