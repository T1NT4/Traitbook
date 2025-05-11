<?php

//Configurações básicas

$host = 'localhost';
$dbname = 'traitbook';
$username = 'root';
$password = '';

//Conexão PDO
try{
    $pdo = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8;", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    die("ERRO TERMINAL - FALHA DE CONEXÃO CRIICA: " . $e->getMessage());
}