<?php

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'nmygsbba_test';
$DATABASE_PASS = '0l0*,tQzmt5~V9tV=Y';
$DATABASE_NAME = 'nmygsbba_blog';
try {
    $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
} catch (PDOException $exception) {

    exit('erreur!');
}

?>