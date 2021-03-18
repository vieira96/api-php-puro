<?php

require_once '../config.php';
require_once '../dao/UserDaoMysql.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'delete') {
    $userDao = new UserDaoMysql($pdo);
    $id = filter_input(INPUT_GET, 'id');
    $user = $userDao->findById($id);
    if($user) {
        $userDao->delete($user->id);
        $array['result'] = 'Usuario deletado com sucesso';
    } else {
        $array['error'] = "Nenhum usuário encontrado com esse ID";
    }
    
    require '../return.php';
} else {
    $array['error'] = "Método não aceito, somente DELETE";
}

require '../return.php';

