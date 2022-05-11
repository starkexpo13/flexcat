<?php

namespace Engine\Model;

use Engine\Database\QueryBuilder;
use Engine\DI\DI;

abstract class Model
{
    /**
     * @var DI
     */
    protected $di;

    protected $db;

    protected $config;

    protected $queryBuilder;

    protected $table = '';

    protected $orderList = 'id';
    protected $model;
    protected $dataFields;

    /**
     * Controller constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
        $this->db = $this->di->get('db');
        $this->config = $this->di->get('config');

        $this->queryBuilder = new QueryBuilder();
        $model = get_class($this);
        $this->class = \Core_GetNameClass::class_basename($model);
        $className = str_replace('Repository', '', $this->class);
        $classNameSpace = "\\". mb_strtolower(ENV) . "\\" . $className . "\\Domain\\". $className;
        if (class_exists($classNameSpace) === true) {
            $this->model = new $classNameSpace();
            $this->dataFields = $this->model->gridFields();
        }
    }


    /**
     * @param string $params
     * @return mixed
     */
    public function getList($params = '')
    {
        if (strlen($params) > 1) {
            $params = explode(':', $params);

            if (is_int(intval($params[1])) && intval($params[1]) <> 0) {
                $whereParam = intval($params[1]);
            } else {
                $whereParam = " '" . $params[1] . "'";
            }

            $where = " WHERE " . $params[0] . "=" . $whereParam;
        } else {
            $where = '';
        }

        return $this->db->query("SELECT * FROM $this->table $where  ORDER BY $this->orderList");
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getData($id)
    {
        if (strlen($this->table) > 0 && intval(htmlspecialchars($id)) <> 0) {

            return $this->db->query("SELECT * FROM $this->table WHERE id = $id");
        }
    }


    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $values = '';
        $valuesData = '';

        foreach ($this->dataFields as $item) {
            if (strlen($data[$item]) > 0) {
                if (is_numeric($data[$item])) {
                    $values .= $item . ",";
                    $valuesData .= "" . $data[$item] . ",";
                } else {
                    $values .= $item . ",";
                    $valuesData .= "'" . $data[$item] . "',";
                }
            }
        }
        $values = mb_substr($values, 0, -1);
        $valuesData = mb_substr($valuesData, 0, -1);

        $this->db->query("INSERT INTO $this->table ($values) VALUES ($valuesData)");

        if ($this->config['PDO_DRIVER'] == 'mysql') {
            return $this->db->query("SELECT LAST_INSERT_ID() as lastID");
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        $values = '';

        foreach ($this->dataFields as $item) {
            if (strlen($data[$item]) > 0 && $item <> 'id') {
                if (is_numeric($data[$item])) {
                    $values .= " $item=" . $data[$item] . ",";
                } else {
                    $values .= " $item='" . $data[$item] . "',";
                }
            }
        }
        $values = mb_substr($values, 0, -1);
        $sql = "UPDATE $this->table SET  $values WHERE id = ". $data['id'];

        return $this->db->query($sql);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $id = trim(htmlspecialchars(stripcslashes($id)));

        if (strlen($this->table) > 0 && intval($id) <> 0) {
            $this->db->query("DELETE FROM $this->table WHERE id = $id");
        }
    }
}