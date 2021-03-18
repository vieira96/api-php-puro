<?php 

class State {
    
    public $id;
    public $user_id;
    public $name;
}

interface StateDao {
    public function createState(State $a);
}