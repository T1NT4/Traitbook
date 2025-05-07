<?php

var_dump($_POST);


$username = $_POST['username'];
$nome_inteiro = $_POST['nome_inteiro'];
$email = $_POST['email'];
$genero = $_POST['genero'];
$aniversario = $_POST['aniversario'];

$sobre_mim = $_POST['sobre_mim'];

$pontos_fortes = [
    $_POST['pontos_fortes0'],
    $_POST['pontos_fortes1'],
    $_POST['pontos_fortes2'],
    $_POST['pontos_fortes3']
];
$pontos_fracos = [
    $_POST['pontos_fracos0'],
    $_POST['pontos_fracos1'],
    $_POST['pontos_fracos2'],
    $_POST['pontos_fracos3']
];

$profissao_atual = $_POST['profissao_atual'];
$minhas_aspiracoes = $_POST['minhas_aspiracoes'];
$meus_principais_objetivos = $_POST['meus_principais_objetivos'];
?>