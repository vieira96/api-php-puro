<?php

require_once '../config.php';
require_once '../dao/UserDaoMysql.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'put') {
    $userDao = new UserDaoMysql($pdo);
    $id = filter_input(INPUT_GET, 'id');
    $user = $userDao->findById($id);
    if($user){
        parse_str(file_get_contents('php://input'), $input);
        $name = $input['name'];
        $password = $input['password'];
        if($name && $password) {
            $user->name = filter_var($name, FILTER_DEFAULT);
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            $result = $userDao->update($user);
            $array['result'] = "Usuário atualizado com sucesso";
        } else {
            $array['error'] = "Algum campo em branco, verifique e tente novamente";
        }
    } else {
        $array['error'] = "Nenhum usuário encontrado com esse ID";
    }
} else {
    $array['error'] = "Método não aceito, somente PUT";
}

require '../return.php';