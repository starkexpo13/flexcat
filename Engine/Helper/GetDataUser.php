<?php


namespace Engine\Helper;

use Engine\Database\Connection;

class GetDataUser
{
    public static $role;

    public static function getRole()
    {
        $db = new Connection();
        $id = $_SESSION['id'];

        if ($id > 0) {
            $result = $db->query("
                SELECT id, role
                    FROM users
                        WHERE id =  " . $id . "
            ");
        }

        return $result[0]->role > 0 ? (int)$result[0]->role : 0;
    }

    public static function getInactive()
    {
        $db = new Connection();
        $id = $_SESSION['id'];

        if ($id > 0) {
            $result = $db->query("
                SELECT id, inactive
                    FROM users
                        WHERE id =  " . $id . "
            ");

            return $result[0]->inactive;
        } else {
            return false;
        }
    }

    public static function getSudirRoles()
    {
        $db = new Connection();
        $id = $_SESSION['id'];

        if ($id > 0) {
            $result = $db->query("
                SELECT id, sudir_roles.sql
                    FROM users
                        WHERE id =  " . $id . "
            ");

            return $result[0]->sudir_roles;
        } else {
            return false;
        }
    }

    public static function getSudirID()
    {
        $db = new Connection();
        $id = $_SESSION['id'];

        if ($id > 0) {
            $result = $db->query("
                SELECT id, sudir_id
                    FROM users
                        WHERE id =  " . $id . "
            ");

            return $result[0]->sudir_id;
        } else {
            return false;
        }
    }

    public static function getSudirLogin()
    {
        $db = new Connection();
        $id = $_SESSION['id'];

        if ($id > 0) {
            $result = $db->query("
                SELECT id, login
                    FROM users
                        WHERE id =  " . $id . "
            ");

            return $result[0]->login;
        } else {
            return false;
        }
    }
}