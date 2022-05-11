<?php

namespace Engine\Database;

use \PDO;
use Engine\Config\Config;
use Dotenv\Dotenv;

class Connection
{
    private $link;
    private $config;

    /**
     * Connection constructor.
     */
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable($_SERVER["DOCUMENT_ROOT"]);
        $this->config = $dotenv->load();

        $this->connect();
    }


    /**
     * @return $this
     */
    public function connect()
    {
        try {
            $dsn = $this->config['PDO_DRIVER'] . ":host=" . $this->config['DB_HOST'] . ";port=" . $this->config['DB_PORT'] . ";dbname=" . $this->config['DB_NAME'];
            $this->link = new PDO($dsn, $this->config['DB_USER'], base64_decode($this->config['DB_PASSWORD']));

            return $this;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param $sql
     * @param array $values
     * @return mixed
     */
    public function execute($sql, $values = [])
    {
        $sth = $this->link->prepare($sql);

        return $sth->execute($values);
    }


    /**
     * @param $sql7
     * @param array $values
     * @return array
     */
    public function query($sql, $values = [], $statement = PDO::FETCH_OBJ)  //$statement = PDO::FETCH_OBJ
    {
        $sth = $this->link->prepare($sql);
        $sth->execute($values);
        $result = $sth->fetchAll($statement); //fetchAll(PDO::FETCH_ASSOC);

        if ($result === false) {
            return [];
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function lastInsertId()
    {
        return $this->link->lastInsertId();
    }
}