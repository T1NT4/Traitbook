<?php
include_once __DIR__ . "/Controller/LoginController.php";
include_once __DIR__ . "/Controller/ApiController.php";
include_once __DIR__ . "/config.php";

$Controller = new LoginController($pdo);
if (!isset($_COOKIE['id_user'])) {
    header("Location: index.php");
}
$id_user = $_COOKIE['id_user'];
$user = $Controller->listarContaPorID($id_user);

$ApiController = new ApiController();
if ($user['link_personalidade'] != null){
    $personalityData = $ApiController->getDataFrom16PersonalitiesLink($user['link_personalidade']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Captura_de_tela_2024-11-11_140326-removebg-preview (1).png" type="image/png">
    <link rel="stylesheet" href="estilo.css">
    <title>Página de perfil</title>
</head>

<body>
    <div class="seila">
        <div class="texto">
            <img width="400" src="View/fotos_de_perfil/<?= $user['nome_arquivo_fotoperfil'] ?>"
                alt="foto de perfil de <?= $user['username'] ?>">
            <p><b>Nome de usuário: </b><?= $user['username'] ?></p>
        </div>
        <div class="navnav">
            <a href="user-actions/mudar-foto-perfil.php">Mudar foto de perfil</a>
            <a href="user-actions/mudar-senha.php">Mudar senha</a>
            <a href="user-actions/logout.php">Sair da conta</a>
            <a href="teste-de-personalidade.php">Teste de personalidade</a>
        </div>
        <?php if(isset($personalityData)):?>
            <div>
                <p><b>Personalidade:</b><?=$personalityData['personalityShort']?></p>
                <img src="<?=$personalityData['details']['cards']['personality']['imageSrc']?>" alt="<?=$personalityData['details']['cards']['personality']['imageAlt']?>" width="200">        
            </div>
        <?php endif;?>
    </div>
    
</body>

</html>