<?php
include_once __DIR__."/Controller/LoginController.php";
include_once __DIR__."/config.php";

$Controller = new LoginController($pdo);

$user = $Controller->listarContaPorID($_COOKIE['id_user']);
    
if(!isset($user)){
    header("location: logout.php");
}

if(!empty($_POST)){
    $username = $user['username'];
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    
    $senhaconfirmada = $Controller->confirmarSenha($username,$password);

    if(!empty($senhaconfirmada)){
        $Controller->updateUser($id_user,$new_password);

        header("Location: ../usuario.php");
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
    <title>Hobbly - Mudar foto de perfil</title>
</head>
<body>
    <section class="marginend marginstart">
        <h4>Atualizar a senha</h4>
        <br>
    <form method="POST" enctype="multipart/form-data" class="login">
    <input required type="password" name="password" placeholder="confirme a senha">
    <input required type="password" name="new_password" placeholder="digite a nova senha">

    <button type="submit">Atualizar senha</button>
    </form>
    <?php
        if(!empty($_POST)){
            echo"<p>sua senha esta incorreta! tente novamente.</p>";
        }
    ?>
    </section>
    
    <?php include "View/footer.php" ?>
</body>
</html>