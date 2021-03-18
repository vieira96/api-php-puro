<?php

require_once '../models/User.php';
require_once '../dao/AddressDaoMysql.php';

class UserDaoMysql {

    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    private function generateUser($array) {
        $u = new User();

        $u->id = $array['id'] ?? '';
        $u->name = $array['name'] ?? '';
        $u->email = $array['email'] ?? '';
        $u->password = $array['password'] ?? '';
        $u->city_id = $array['city_id'] ?? '';
        $u->state_id = $array['state_id'] ?? '';
        $u->address_id = $array['address_id'] ?? '';

        return $u;
    }

    
    public function findById($id)
    {
        if(!empty($id)){
            $sql = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $user = $this->generateUser($data);

                return $user;
            }
            
        }

        return false;
    }

    public function findByEmail($email)
    {
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();
        if($sql->rowCount()) {
            return $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function update(User $u)
    {
        $sql = $this->pdo->prepare("UPDATE users SET
            password = :password,
            name = :name,
            id = :id 
        WHERE id = :id");

        $sql->bindValue(":password", $u->password);
        $sql->bindValue(":name", $u->name);
        $sql->bindValue(":id", $u->id);
        var_dump('user', $u);   
        $sql->execute();

        return true;
    }

    public function delete($id) {
        $sql = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function insert(User $u)
    {
        $sql = $this->pdo->prepare("INSERT INTO users (name, email, password, city_id, state_id, address_id) VALUES (:name, :email, :password, :city_id, :state_id, :address_id)");
        $sql->bindValue(":name", $u->name);
        $sql->bindValue(":email", $u->email);
        $sql->bindValue(":password", $u->password);
        $sql->bindValue(":city_id", $u->city_id);
        $sql->bindValue(":state_id", $u->state_id);
        $sql->bindValue(":address_id", $u->address_id);
        if($sql->execute()){
            return $u;
        } else {
            return false;
        }
    }

    public function countUsersByCity()
    {   
        $sql = $this->pdo->prepare("SELECT COUNT(city_id) AS quantity FROM users WHERE city_id = 1");
        $sql->execute();
        return $sql->fetch();
    }

    public function countUsersByState($state_id)
    {   
        $sql = $this->pdo->prepare("SELECT COUNT(state_id) AS quantity FROM users WHERE state_id = :state_id");
        $sql->bindValue('state_id', $state_id);
        $sql->execute();
        return $sql->fetch();
    }
}