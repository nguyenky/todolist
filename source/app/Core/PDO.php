<?php

namespace App\Core;

use PDOException;

class PDO extends Database
{
    protected $query;
    protected $columns = ['*'];
    protected $bindingValues = [];
    protected $bindingColumns = [];
    protected $limit = 0;
    protected $offset = 0;
    protected $conditions = [];
    protected $valuesUpdate = [];
    protected $valuesInsert =[];

    /**
     * PDO constructor.
     *
     * @param $server_name
     * @param $db_name
     * @param $username
     * @param $password
     * @param $charset
     */
    public function __construct($server_name, $db_name, $username, $password, $charset)
    {
        parent::__construct($server_name, $db_name, $username, $password, $charset);
        $this->connect();
    }

    public function connect()
    {
        try {
            $options = [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->conn = $this->conn ?? new \PDO(
                "mysql:host=$this->server_name;dbname=$this->db_name;charset=$this->charset",
                $this->username,
                $this->password,
                $options
            );
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    protected function prepareQuery()
    {
        $this->query = 'SELECT ' . implode(',', $this->columns)
            . ' FROM `' . $this->table . '`'
            . $this->renderConditions()
            .(!empty($this->limit) || !empty($this->offset) ? ' LIMIT '
            . (int) $this->offset
            .  ','
            . (int) $this->limit : '')
        ;

        return $this->conn->prepare($this->query);
    }

    private function renderConditions()
    {
        $conditions = '';
        if (!empty($this->conditions)) {
            foreach ($this->conditions as $column => $condition) {
                $conditions .= empty($conditions)
                    ? ' where ' . $column . '=' . $condition
                    : ' and where ' . $column . '=' . $condition;
            }
        }
        return $conditions;
    }

    public function __call($funName, $arguments)
    {
        return $this->conn[$funName]($arguments);
    }
}