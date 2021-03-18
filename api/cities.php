<?php

require_once '../config.php';
require_once '../dao/CityDaoMysql.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'get') {

    $id = filter_input(INPUT_GET, 'id');
    $cityDao = new CityDaoMysql($pdo);

    if($id) {
        $city = $cityDao->findById($id);
        if($address) {
            $array['result'] = $city;
        }else {
            $array['result'] = "Nenhuma cidade encontrada com esse ID";
        }
    } else {
        $cities = $cityDao->findAll();
        if($adresses) {
            $array['result'] = $cities;
        }else {
            $array['result'] = "Nenhuma cidade cadastrada";
        }
    }
} else {
    $array['error'] = "Método não aceito, somente GET";
}

require '../return.php';

