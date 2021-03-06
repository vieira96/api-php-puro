<?php

require_once '../config.php';
require_once '../dao/UserDaoMysql.php';
require_once '../dao/StateDaoMysql.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'get') {
    $userDao = new UserDaoMysql($pdo);
    $stateDao = new StateDaoMysql($pdo);
    $states = $stateDao->findAll();
    foreach($states as $state) {
        //pego a quantidade de usuários com o id do estado
        $count = $userDao->countUsersByState($state['id']);
        $results[] = 'Existem ' . $count['quantity'] . ' usuários cadastrados com o estado ' . $state['name'];
    }

    $array['result'] = $results;
    
} else {
    $array['error'] = "Método não aceito, somente GET";
}

require '../return.php';

