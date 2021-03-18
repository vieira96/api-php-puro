<?php 

class City {
    
    public $id;
    public $name;
}

interface CityDao {
    public function createCity(City $a);
}