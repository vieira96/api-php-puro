<?php

require_once '../models/State.php';

class StateDaoMysql {

    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function findByName(State $s)
    {
        $sql = $this->pdo->prepare("SELECT * FROM states WHERE name = :name");
        $sql->bindValue(":name", $s->name);
        $sql->execute();
        if($sql->rowCount()) {
            return $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function findAll()
    {
        $sql = $this->pdo->prepare("SELECT * FROM states");
        $sql->execute();
        if($sql->rowCount()) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function findById($id, $full = false)
    {
        if(!empty($id)){
            $sql = $this->pdo->prepare("SELECT * FROM states WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            if($sql->rowCount()) {
                return $sql->fetch(PDO::FETCH_ASSOC);
            }
        }

        return false;
    }

    public function insert(State $s)
    {
        $sql = $this->pdo->prepare("INSERT INTO states (name) VALUES (:name)");
        $sql->bindValue(":name", $s->name);
        if($sql->execute()){
            return $this->pdo->lastInsertId();
        }
    }
}