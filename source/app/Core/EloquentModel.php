<?php

namespace App\Core;

use App\Exceptions\HttpException;

class EloquentModel extends PDO
{
    protected $table;
    protected $fillables = [];

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

    public function where($column, $value)
    {
        $this->conditions[$column] = $value;

        return $this;
    }

    public function limit(int $limit = 500)
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset = 0)
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * Get records
     */
    public function get()
    {
        $prepare = $this->prepareQuery();
        $prepare->execute();
        $data = $prepare->fetchAll(\PDO::FETCH_CLASS, get_class($this));
        return $data;
    }

    /**
     * Insert data to db
     * @param array $attributes
     *
     * @return array
     */
    public function insert(array $attributes)
    {
        $this->valuesInsert = $attributes;
        $prepare = $this->prepareInsertQuery();
        $prepare->execute();
        return $prepare->fetchAll(\PDO::FETCH_CLASS, get_class($this));
    }

    public function find(int $id)
    {
        $this->limit = 1;
        $this->where('id', $id);
        $prepare = $this->prepareQuery();
        $prepare->execute();
        $data = $prepare->fetchAll(\PDO::FETCH_CLASS, get_class($this));

        if (empty($data)) {
            throw new HttpException();
        }

        return $data[0];
    }

    public function update(int $id, array $attributes)
    {
        $this->valuesUpdate = $attributes;
        $prepare = $this->prepareUpdateQuery($id);
        $prepare->execute();
        return $prepare->fetchAll(\PDO::FETCH_CLASS, get_class($this));
    }

    public function delete(int $id)
    {
        $prepare = $this->prepareDeleteQuery($id);
        $prepare->execute();
        $prepare->fetchAll(\PDO::FETCH_CLASS, get_class($this));

        return true;
    }

    /**
     * @return array
     */
    public function getFillables(): array
    {
        return $this->fillables;
    }
}
