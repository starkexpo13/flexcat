<?php


namespace admin\Users\Model;


use Engine\Model\Model;

class UsersRepository extends Model
{
    protected $table = 'users';
    protected $orderList = 'name';

    public function clear($id)
    {
        $time = time();

        $this->db->query("DELETE FROM result_test WHERE idus = $id");

        $sql = "UPDATE $this->table SET block = 0, testinguser = 0, result=0, lastvisitDate='$time', datetest=0, testingstatus = 0  WHERE id = ". $id;

        return $this->db->query($sql);
    }

    public function getResult($id)
    {
        return $this->db->query("SELECT * FROM result_test WHERE idus = $id");
    }
}