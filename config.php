<?php

$base = "http://localhost/api-php-puro";
$db_name = "api-php-puro";
$db_host = "localhost";
$db_user = "root";
$db_pass = "root";

$array = [
    'error' => '',
    'result' => ''
];

try {
    $pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);
} catch (PDOException $e) {
    echo "Erro BD: " . $array = ['error' => $e->getMessage()];
}