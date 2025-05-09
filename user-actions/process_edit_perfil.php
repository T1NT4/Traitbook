<?php
include_once __DIR__."/../Controller/LoginController.php";
include_once __DIR__."/../Controller/ApiController.php";
include_once __DIR__."/../config.php";

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

$pontos_fortes = json_encode($pontos_fortes);
$pontos_fracos = json_encode($pontos_fracos);

$profissao_atual = $_POST['profissao_atual'];
$minhas_aspiracoes = $_POST['minhas_aspiracoes'];
$meus_principais_objetivos = $_POST['meus_principais_objetivos'];

$Controller = new LoginController($pdo);

$Controller->updateEverything(
    $_COOKIE['id_user'],
    $username,
    $nome_inteiro,
    $email,
    $aniversario,
    $genero,
    $sobre_mim,
    $pontos_fracos,
    $pontos_fortes,
    $profissao_atual,
    $minhas_aspiracoes,
    $meus_principais_objetivos);

header('Location: ../usuario.php');
?>