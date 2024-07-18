<?php

namespace Core;

use Core\MysqlDatabase;
use PDO;
use ReflectionClass;

class Model
{
    protected $table;
    protected $database;

    public function __construct(MysqlDatabase $database)
    {
        $this->database = $database;
        $this->table = $this->getTableName();
    }

    protected function getTableName()
    {
        $class = (new ReflectionClass($this))->getShortName();
        // var_dump(strtolower(str_replace('Model', '', $class)).'s');

        // die();
        return strtolower(str_replace('Model', '', $class) . 's');

    }

    public function getEntityClass()
    {
        $class = (new ReflectionClass($this))->getShortName();
        $entityClass = "Entity\\" . str_replace('Model', 'Entity', $class);

        if (!class_exists($entityClass)) {
            throw new \Exception("Entity class $entityClass not found.");
        }

        return $entityClass;
    }

    public function query($sql, $params = [], $entityClass = null)
    {
        if ($entityClass) {
            return $this->database->query($sql, $params, PDO::FETCH_CLASS, $entityClass);
        }
        return $this->database->query($sql, $params);
    }

    public function all()
    {
        $entityClass = $this->getEntityClass();
        return $this->query("SELECT * FROM {$this->table}", [], $entityClass);
    }

    public function prepare($sql)
    {
        return $this->database->prepare($sql);
    }

    public function searchByAttribute($attribute, $value)
    {
        $entityClass = $this->getEntityClass();
        return $this->query("SELECT * FROM {$this->table} WHERE $attribute = :value", ['value' => $value], $entityClass);
    }

    public function save($data)
    {

        $id = $data['id'] ?? null;
        if ($id) {
            return $this->update($id, $data);
        } else {
            return $this->insert($data);
        }
    }

    protected function insert($data)
    {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($values)";

        return $this->query($sql, $data);
    }

    protected function update($id, $data)
    {
        $columns = '';
        foreach ($data as $key => $value) {
            $columns .= "$key = :$key, ";
        }
        $columns = rtrim($columns, ', ');

        $sql = "UPDATE {$this->table} SET $columns WHERE id = :id";
        $data['id'] = $id;

        return $this->query($sql, $data);
    }

    public function delete($id)
    {
        return $this->query("DELETE FROM {$this->table} WHERE id = :id", ['id' => $id]);
    }

    protected function instantiateClass($className)
    {
        // var_dump($className);

        try {
            $reflectionClass = new \ReflectionClass($className);
            return $reflectionClass->newInstance($this->database);
        } catch (\ReflectionException $e) {
            throw new \Exception("Class $className not found or not instantiable");
        }
    }

    public function hasMany($entityClass, $foreignKey, $localKey)
    {
        $entity = $this->instantiateClass($entityClass);
        $table = $entity->getTableName();
        // var_dump($table);
        $entityClass = $entity->getEntityClass();
        $sql = "SELECT * FROM $table WHERE $foreignKey = :localKey";
        return $this->query($sql, ['localKey' => $localKey], $entityClass);
    }

    public function belongsTo($entityClass, $foreignKey, $localKey)
    {
        $entity = $this->instantiateClass($entityClass);
        $table = $entity->getTableName();
        $entityClass = $entity->getEntityClass();
        $sql = "SELECT * FROM $table WHERE $foreignKey = :localKey LIMIT 1";
        return $this->query($sql, ['localKey' => $localKey], $entityClass);
    }

    public function belongsToMany($entityClass, $foreignKey, $localKey, $pivotTable)
    {
        $entity = $this->instantiateClass($entityClass);
        $table = $entity->getTableName();
        $entityClass = $entity->getEntityClass();
        $entity2 = $this->instantiateClass($pivotTable);
        $table2 = $entity2->getTableName();
        // $entityClass2 = $entity2->getEntityClass();
        $sql = "SELECT * FROM $table INNER JOIN $table2 ON $table2.idarticle = $table.id WHERE $table2.$foreignKey = :localKey";
        // var_dump($sql);
        return $this->query($sql, ['localKey' => $localKey], $entityClass);
    }

    public function lastInsertId()
    {
        return $this->database->lastInsertId();
    }
    public function transaction($callback)
    {
        try {
            $this->database->beginTransaction();
            $callback($this);
            $this->database->commit();
        } catch (\Exception $e) {
            $this->database->rollBack();
            throw $e;
        }
    }
    public function filterAndPaginate($filter,$id, $offset=null, $pageSize=null)
    {
        // var_dump($offset, $pageSize);
        // Construire la requête SQL avec les filtres
        $sql = "SELECT * FROM $this->table WHERE idclient=:idclient ";
        if ($filter == "all") {
            $sql .= "";
        } elseif ($filter == "unpaid") {
            $sql .= " and montant > montantverse";
        } elseif ($filter == "paid") {
            $sql .= "and montant = montantverse";
        }
if ($offset == null&& $pageSize == null) {
    echo"dfdfd";
    $sql .= "";
}else{
    echo"dfdfd22";

    $sql .= " LIMIT " . intval($offset) . ", " . intval($pageSize);

}
        $arr=[
            "idclient"=>$id,
            ];
var_dump($sql);
            return $this->query($sql, $arr, $this->getEntityClass());
    }

    // belongsTo

    //hasOne
    //hasOneThrough

    //hasManyThrough
    //belongsToManyThrough

    //hasMany
    //belongsTo
    //belongsToMany
    //transaction

}
