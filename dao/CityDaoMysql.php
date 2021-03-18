<?php

require_once '../models/City.php';

class CityDaoMysql {

    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function findByName(City $c)
    {
        $sql = $this->pdo->prepare("SELECT * FROM cities WHERE name = :name");
        $sql->bindValue(":name", $c->name);
        $sql->execute();
        if($sql->rowCount()) {
            return $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function findAll()
    {
        $sql = $this->pdo->prepare("SELECT * FROM cities");
        $sql->execute();
        if($sql->rowCount()) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function findById($id, $full = false)
    {
        if(!empty($id)){
            $sql = $this->pdo->prepare("SELECT * FROM cities WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
            
        }

        return false;
    }

    public function insert(City $c)
    {
        $sql = $this->pdo->prepare("INSERT INTO cities (name) VALUES (:name)");
        $sql->bindValue(":name", $c->name);
        if($sql->execute()){
            return $this->pdo->lastInsertId();
        }else {
        }
    }
}