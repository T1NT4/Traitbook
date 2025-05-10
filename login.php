<?php
include_once __DIR__."/Controller/LoginController.php";
include_once __DIR__."/config.php";

$Controller = new LoginController($pdo);

if(!empty($_POST)){
    $username = $_POST['username_or_email'];
    $password = $_POST['password'];

    $logged_in = $Controller->logIn($username, $password);

    if(!empty($logged_in)){
        // faz um cookie para marcar o login do usuário na máquina dele por 24 horas
        setcookie("id_user",$logged_in["id_user"], time()+60*60*24, "/");
        
        header("Location: usuario.php");
    }

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

                    <div>
                        <h3 class="width-100po">Nome de usuário ou Email:</h3>
                        <input required type="text" name="username_or_email" class="minwidth-300" placeholder="Nome de usuário ou email">
                    </div>
                    <div>
                        <h3 class="width-100po">Sua senha:</h3>
                        <input required type="password" name="password" class="minwidth-300" placeholder="Senha">
                    </div>

                    <button type="submit" class="button glass self-align-center"><h1>Login</h1></button>

                    <p><a href="esqueceu-senha.php">Esqueceu a sua Senha?</a></p>
                    <p>Não tem uma conta? registre uma <a href="register.php">aqui!</a></p>
                    <?php if(isset($logged_in) && empty($logged_in)): ?>
                        <p>usuário ou senha estão errados, tente novamente! </p>
                    <?php endif; ?>
                    </div>
                </div>
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