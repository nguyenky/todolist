<?php

namespace App\Core;

abstract class Database
{
    protected $server_name;
    protected $username;
    protected $password;
    protected $db_name;
    protected $conn;
    protected $charset;

    protected function __construct($server_name, $db_name, $username, $password, $charset)
    {
        $this->server_name = $server_name;
        $this->db_name = $db_name;
        $this->username = $username;
        $this->password = $password;
        $this->charset = $charset;
    }

    abstract protected function connect();

    protected function close()
    {
        $this->conn->close();
    }
}
