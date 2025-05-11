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

$contaUsername = $Controller->listarContaPorUsername($username);

$usernameValid = $contaUsername['id_user'] == intval($_COOKIE['id_user']);
if(!$usernameValid){
    $usernameValid = empty($contaUsername);
}


$contaEmail = $Controller->listarContaPorEmail($email);

$emailValid = $contaEmail['id_user'] == intval($_COOKIE['id_user']);
if(!$emailValid){
    $emailValid = empty($contaEmail);
}

if($usernameValid AND $emailValid){

        
    $imagem_arquivo = $_FILES['foto_perfil'];
    if($imagem_arquivo['name'] != ''){
        $diretorio_override = "../View/fotos_de_perfil/";
        include __DIR__.'/../upload-image.php';
            
        $error_code = 0;

        if($error_code == null){
            $Controller->updateFotoPerfil($_COOKIE['id_user'],$nome_arquivo_fotoperfil);
            var_dump($nome_arquivo_fotoperfil);
        }

        $Controller->updateFotoPerfil($_COOKIE['id_user'], $nome_arquivo_fotoperfil);
    }

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
}else{
    if(!$usernameValid){
        $edit_perfil_error_code = 'Este Nome de Usuário já está sendo usado, tente novamente.';
    }
    if(!$emailValid){
        $edit_perfil_error_code = 'Este Email já está sendo usado, tente novamente.';
    }
    if(!$emailValid AND !$usernameValid){
        $edit_perfil_error_code = 'Este Email e Nome de Usuário já estão sendo usados, tente novamente.';
    }
    setcookie("edit_perfil_error_code",$edit_perfil_error_code, time()+10, "/");
    header('Location: ../edit_perfil.php');
}

?>