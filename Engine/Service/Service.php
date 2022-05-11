<?php


namespace Engine\Service;

 use Engine\Database\QueryBuilder;
 use Engine\DI\DI;

abstract class Service
{
     protected $di;
     protected $db;
     protected $config;
     protected $data;


    public function __construct(DI $di)
    {
        $this->di = $di;
        $this->db = $this->di->get('db');
        $this->config = $this->di->get('config');
    }

     protected function getList($table, $params = '', $order = '')
     {
         if (strlen($params) > 1) {
             $params = explode(':', $params);

             if (is_int(intval($params[1])) && intval($params[1]) <> 0) {
                 $whereParam = intval($params[1]);
             } else {
                 $whereParam = " '" . $params[1] . "'";
             }
             if (strlen($order) > 0) {
                 $order = " ORDER BY $order";
             }

             $where = " WHERE " . $params[0] . "=" . $whereParam;
         } else {
             $where = '';
         }

         return $this->db->query("SELECT * FROM $table $where  $order");
     }

     protected function getId($table, $id)
     {
         if (strlen($table) > 0 && intval(htmlspecialchars($id)) <> 0) {

             return $this->db->query("SELECT * FROM $table WHERE id = $id");
         }
     }


}