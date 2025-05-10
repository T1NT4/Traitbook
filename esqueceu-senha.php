<?php
include_once __DIR__."/Controller/LoginController.php";
include_once __DIR__."/config.php";

$Controller = new LoginController($pdo);

if(!empty($_POST)){
    
    $result = $Controller->listarContaPorEmail($_POST['email']);
    if(!empty($result)){
        $Controller->updateUserWithEmail($_POST['email'],$_POST['password']);
        
        setcookie("mudou_senha",'Senha mudada com sucesso!', time()+10, "/");
        header('Location: login.php');
    };

    $error_code = 'Email incorreto! Tente novamente';
}

if(isset($_COOKIE['id_user'])){
    $user = $Controller->listarContaPorID($_COOKIE['id_user']);
    $nome_arquivo_fotoperfil = $Controller->getFotoPerfil($user['nome_arquivo_fotoperfil'], __DIR__);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Traitbook - Página de LogIn</title>
    <link rel="stylesheet" href="View/style.css">
    <link rel="shortcut icon" href="View/imgs/logo-icon.png" type="image/x-icon">
</head>
<body>

    <?php include __DIR__."/View/header.php";?>


    <form method="POST">
        <section>
            <div class="flex-row flex-wrap-at-760 justify-center">
                <div class="glass flex-column align-center flex-column-at-760 width-fitcontent">
                    <?php if(isset($error_code)):?>
                        <h1><?=$error_code?></h1>
                    <?php endif;?>
                    <div>
                        <h3 class="width-100po">Email:</h3>
                        <input required type="email" name="email" class="minwidth-300" placeholder="Seu email">
                    </div>
                    <div>
                        <h3 class="width-100po">Sua senha nova:</h3>
                        <input required type="password" name="password" class="minwidth-300" placeholder="Nova Senha">
                    </div>

                    <button type="submit" class="button glass self-align-center"><h1>Login</h1></button>
        </section>
    </form>
    
    <div class="background" id="background">
        <div class="background-img"></div>
        <div class="background-img"></div>
    </div>
    <?php include __DIR__."/View/footer.php";?>

</body>
<script src="View/js/ajustarAlturaBackground.js"></script>

</html>