<?php

require_once '../config.php';
require_once '../dao/CityDaoMysql.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'get') {

    $id = filter_input(INPUT_GET, 'id');
    $stateDao = new StateDaoMysql($pdo);

    if($id) {
        $state = $stateDao->findById($id);
        if($state) {
            $array['result'] = $state;
        }else {
            $array['result'] = "Nenhum estado encontrado com esse ID";
        }

    } else {
        $states = $stateDao->findAll();
        if($states) {
            $array['result'] = $states;
        }else {
            $array['result'] = "Nenhum estado cadastrado";
        }
    }
    require '../return.php';
} else {
    $array['error'] = "Método não aceito, somente GET";
}

require '../return.php';

