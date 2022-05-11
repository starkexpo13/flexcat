<?php


namespace Engine\Database;


class QueryBuilder
{
    protected $sql = [];

    public $values = [];

    public function select($fields = '*')
    {
        $this->reset();
        $this->sql['select'] = "SELECT ($fields) ";

        return $this;
    }

    /**
     * @param $table
     * @return $this
     */
    public function from($table)
    {
        $this->sql['from'] = " FROM {$table} ";

        return $this;
    }

    /**
     * @param $column
     * @param $value
     * @param string $operator
     * @return $this
     */
    public function where($column, $value, $operator = ' = ')
    {
        $this->sql['where'][] = "{$column} {$operator}";
        $this->values[] = $value;

        return $this;
    }

}