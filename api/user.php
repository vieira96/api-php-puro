<?php

require_once '../config.php';
require_once '../dao/UserDaoMysql.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'get') {
    $userDao = new UserDaoMysql($pdo);
    $id = filter_input(INPUT_GET, 'id');
    $user = $userDao->findById($id);
    if($user) {
        $array['result'] = $user;
    } else {
        $array['error'] = "Nenhum usuário encontrado com esse ID";
    }
    
} else {
    $array['error'] = "Método não aceito, somente GET";
}

require '../return.php';

