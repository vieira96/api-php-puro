<?php 

class Address {
    
    public $id;
    public $user_id;
    public $street;
    public $number;
}

interface AddresDao {
    public function createAddress(Address $a);
}