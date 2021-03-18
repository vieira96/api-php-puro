<?php

class User {

    public $id;
    public $email;
    public $password;
    public $name;
    public $city_id;
    public $state_id;
    public $address_id;
}

interface UserDAO {
    public function findById($id);
    public function update(User $u);
    public function insert(User $u);
} 