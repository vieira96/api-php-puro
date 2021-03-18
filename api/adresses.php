<?php

//puxo as configurações globais
require_once '../config.php';

require_once '../dao/AddressDaoMysql.php';

//pego o metodo
$method = strtolower($_SERVER['REQUEST_METHOD']);

//verifico se é um metodo valido
if($method === 'get') {

    //pego o id que vem da url
    $id = filter_input(INPUT_GET, 'id');
    $addressDao = new AddressDaoMysql($pdo);

    //verifico se tem um id para exibir a informação de um endereço, se n tiver o id mostro todos os endereços.
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

