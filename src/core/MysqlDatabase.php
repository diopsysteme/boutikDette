<?php

namespace Core;

use PDO;
use PDOException;

class MysqlDatabase
{
    private $pdo;

    public function __construct($dsn,$username,$password)
    {
        
        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query($sql, $params = [], $fetchMode = PDO::FETCH_ASSOC, $fetchClass = null)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        if ($fetchClass) {
            $stmt->setFetchMode($fetchMode, $fetchClass);
        } else {
            $stmt->setFetchMode($fetchMode);
        }

        return $stmt->fetchAll();
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

}