<?php
namespace App\Database;

use App\Core\PDO;

class Migration extends PDO
{
    public function __construct()
    {
        parent::__construct(
            config('database.connection.host'),
            config('database.connection.database'),
            config('database.connection.username'),
            config('database.connection.password'),
            config('database.connection.charset')
        );
    }

    public function __invoke()
    {
        $query = $this->createTodotable();
        
        if ($query) {
            $this->perform($query);
        }
    }

    private function perform($query)
    {
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_CLASS, get_class($this));
    }

    protected function createTodotable()
    {
        $query = $this->conn->prepare('SHOW TABLES LIKE "todos"');

        if (!empty($this->perform($query))) {
            return;
        }

        $this->query = 'CREATE TABLE todos (id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                            name VARCHAR(100) NOT NULL,
                            start_date DATE NOT NULL,
                            end_date DATE NOT NULL,
                            status VARCHAR(20) NOT NULL,
                            PRIMARY KEY(id)) DEFAULT CHARACTER
                        SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB';

        return $this->conn->prepare($this->query);
    }
}
