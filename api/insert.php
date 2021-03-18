<?php 

require_once '../config.php';
require_once '../dao/UserDaoMysql.php';
require_once '../dao/AddressDaoMysql.php';
require_once '../dao/CityDaoMysql.php';
require_once '../dao/StateDaoMysql.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'post') {

    //filtro todos os campos
    //todos são campos obrigatórios
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password'); 
    $street_name = filter_input(INPUT_POST, 'street');
    $number = filter_input(INPUT_POST, 'number');
    $state_name = filter_input(INPUT_POST, 'state_name');
    $city_name = filter_input(INPUT_POST, 'city_name');

    if($name && $email && $password && $street_name && $number && $state_name && $city_name){

        $userDao = new UserDaoMysql($pdo);
        $newUser = new User();
    
        $newUser->name = $name;
        //verifico se ja existe um usuário com o email
        if(!$userDao->findByEmail($email)) {
            $newUser->email = $email;
            $newUser->password = password_hash($password, PASSWORD_DEFAULT);
        
            $stateDao = new StateDaoMysql($pdo);
            $newState = new State();
            $newState->name = ucfirst($state_name);
            if($state = $stateDao->findByName($newState)){
                $newUser->state_id = $state['id'];
            } else {
                $newUser->state_id = $stateDao->insert($newState);
            }
        
            $cityDao = new CityDaoMysql($pdo);
            $newCity = new City();
            $newCity->name = ucfirst($city_name);
            if($city = $cityDao->findByName($newCity)){
                $newUser->city_id = $city['id'];
            } else {
                $newUser->city_id = $cityDao->insert($newCity);
            }

            $addressDao = new AddressDaoMysql($pdo);
            $newAddress = new Address();
            $newAddress->street = $street_name;
            $newAddress->number = $number;
            $address = $addressDao->insert($newAddress);
            $newUser->address_id = $address;

            $result = $userDao->insert($newUser);

            $array['result'] = 'usuario inserido com sucesso';
        } else {
            $array['error'] = "Já existe um usuário cadastrado com esse e-mail";
        }
    } else {
        $array['error'] = "Existem campos vazios, por favor, verifique e tente novamente";
    }

} else {
    $array['error'] = 'Método não aceito, somente POST';
}

require '../return.php';
