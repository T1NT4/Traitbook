<?php
include_once __DIR__."/../Controller/LoginController.php";
include_once __DIR__."/../config.php";

$Controller = new LoginController($pdo);

$user = $Controller->listarContaPorID($_COOKIE['id_user']);
    
if(!isset($user)){
    header("location: logout.php");
}

if(!empty($_POST)){
    $username = $user['username'];
    $password = $_POST['password'];
    
    $senhaconfirmada = $Controller->confirmarSenha($username,$password);

    if(!empty($senhaconfirmada)){
        $imagem_arquivo = $_FILES['foto-perfil'];
        $diretorio_override = "../View/fotos_de_perfil/";
        include __DIR__.'/../upload-image.php';
    
        $error_code = 0;

        if($error_code == null){
            $Controller->updateFotoPerfil($_COOKIE['id_user'],$nome_arquivo_fotoperfil);
            var_dump($nome_arquivo_fotoperfil);
            header("Location: ../usuario.php");
        }
    }

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <link rel="shortcut icon" href="Captura_de_tela_2024-11-11_140326-removebg-preview (1).png" type="image/png">
    <title>Mudar foto de perfil</title>
</head>
<body>
    <section class="marginend marginstart">
        <h4>Atualizar a foto de perfil</h4>
        <br>
    <form class="login" method="POST" enctype="multipart/form-data">
    <input required type="password" name="password" placeholder="confirme a senha">
    <div>
    <label for="foto-perfil">nova foto de perfil: </label>
    <input required type="file" name="foto-perfil" accept="image/jpg, image/jpeg, image/png, image/gif">
    </div>    
    
    <button type="submit">Atualizar foto de perfil</button>
    </form>
    <?php
        if(!empty($_POST)){
            echo"<p>errou a senha! tente novamente.</p>";
        }
        if(isset($error_code) && $error_code != null){
            echo $error_code;
        }
    ?>
    </section>
    
</html>