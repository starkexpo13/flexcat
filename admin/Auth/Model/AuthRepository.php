<?php


namespace admin\Auth\Model;


use Engine\Model\Model;

class AuthRepository extends Model
{
    protected $table = 'users';
    protected $orderList = 'name';


    public function getUser($login, $password)
    {
        return $this->db->query("SELECT * FROM $this->table WHERE username = '". $login."' AND password = '". $password ."' AND level = 3");
    }
}