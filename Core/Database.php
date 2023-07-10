<?php

namespace Core;
use PDO;

class Database{

    public PDO $connection;
    public $statement;


    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = []){
        $this->statement = $this->connection->prepare($query);


        $this->statement->execute($params);

        return $this;
    }

    public function find(){
        return $this->statement->fetch();
    }
    public function findOrFail(){
        if (! $result = $this->find()){
            abort();
        }

        return $result;
    }

    public function all(){
        return $this->statement->fetchAll();
    }
}