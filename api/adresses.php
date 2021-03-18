<?php

require_once '../config.php';
require_once '../dao/AddressDaoMysql.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'get') {

    $id = filter_input(INPUT_GET, 'id');
    $addressDao = new AddressDaoMysql($pdo);

    if($id) {
        $address = $addressDao->findById($id);
        if($address) {
            $array['result'] = $address;
        }else {
            $array['result'] = "Nenhum endereço encontrado com esse ID";
        }
    } else {
        $adresses = $addressDao->findAll();
        if($adresses) {
            $array['result'] = $adresses;
        }else {
            $array['result'] = "Nenhum endereço cadastrado";
        }
    }
}else {
    $array['error'] = "Método não aceito, somente GET";
}

require '../return.php';

