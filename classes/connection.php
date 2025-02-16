<?php

$dsn = 'mysql:host=localhost;dbname=return';

$user ='root' ;

$pass = '';

try {
    $db = new PDO($dsn,$user,$pass);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}

catch (PDOException $e) {
    echo 'Faild' .$e->getmessage();
}


