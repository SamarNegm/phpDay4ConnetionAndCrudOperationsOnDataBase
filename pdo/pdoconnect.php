<?php




ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

function connectToDatabase(){
    $dsn = 'mysql:dbname=iti;host=127.0.0.1;port=3306;'; #port number
    $user = 'root';
    $password = '';
    $db= new PDO($dsn, $user, $password);
    var_dump($db);

    return $db;

}