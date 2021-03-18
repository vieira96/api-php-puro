<?php

require_once '../config.php';
require_once '../dao/UserDaoMysql.php';
require_once '../dao/CityDaoMysql.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'get') {
    $userDao = new UserDaoMysql($pdo);
    $cityDao = new CityDaoMysql($pdo);
    $cities = $cityDao->findAll();
    foreach($cities as $city) {
        $count = $userDao->countUsersByState($city['id']);
        $results[] = 'Existem ' . $count['quantity'] . ' usuários cadastrados com a cidade ' . $city['name'];
    }

    $array['result'] = $results;
    
    require '../return.php';
} else {
    $array['error'] = "Método não aceito, somente GET";
}

require '../return.php';

