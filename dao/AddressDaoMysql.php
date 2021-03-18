<?php

require_once '../models/Address.php';

class AddressDaoMysql {

    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function findAll()
    {
        $sql = $this->pdo->prepare("SELECT * FROM adresses");
        $sql->execute();
        if($sql->rowCount()) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
    public function findById($id, $full = false)
    {
        if(!empty($id)){
            $sql = $this->pdo->prepare("SELECT * FROM adresses WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
            if($sql->rowCount()) {
                return $sql->fetch(PDO::FETCH_ASSOC);
            }
        }

        return false;
    }

    public function insert(Address $a)
    {
        $sql = $this->pdo->prepare("INSERT INTO adresses (street, number) VALUES (:street, :number)");
        $sql->bindValue(":street", $a->street);
        $sql->bindValue(":number", $a->number);
        if($sql->execute()){
            return $this->pdo->lastInsertId();
        } else {
            return false;
        }
    }
}