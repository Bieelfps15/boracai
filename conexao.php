<?php

$DATABASE = 'boracai';
$HOST = 'localhost';
$USER = 'root';
$PASS = '';
$OPTIONS = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];
try {
    $pdo = new PDO('mysql:host=' . $HOST . ';dbname=' . $DATABASE . ';charset=utf8', $USER, $PASS, $OPTIONS);
} catch (PDOException $e) {
    echo $e->getMessage() . "</p>";
    die();
}