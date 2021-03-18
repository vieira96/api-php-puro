<?php

require_once '../config.php';
require_once '../dao/UserDaoMysql.php';
require_once '../dao/StateDaoMysql.php';
require_once '../dao/CityDaoMysql.php';
require_once '../dao/AddressDaoMysql.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'get') {
    $userDao = new UserDaoMysql($pdo);
    $id = filter_input(INPUT_GET, 'id');
    $user = $userDao->findById($id);
    if($user) {
        $addressDao = new AddressDaoMysql($pdo);
        $cityDao = new CityDaoMysql($pdo);
        $stateDao = new StateDaoMysql($pdo);
        $user->address = $addressDao->findById($user->address_id);
        $user->city = $cityDao->findById($user->city_id);
        $user->state = $stateDao->findById($user->state_id);
        $array['result'] = $user;
    } else {
        $array['error'] = "Nenhum usuário encontrado com esse ID";
    }
    
} else {
    $array['error'] = "Método não aceito, somente GET";
}

require '../return.php';

