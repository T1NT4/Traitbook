<?php
include_once __DIR__."/Controller/LoginController.php";
include_once __DIR__."/config.php";

$Controller = new LoginController($pdo);

if(!empty($_POST)){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $logged_in = $Controller->logIn($username, $password);

    if(!empty($logged_in)){
        // faz um cookie para marcar o login do usuário na máquina dele por 24 horas
        setcookie("id_user",$logged_in["id_user"], time()+60*60*24, "/");
        
        header("Location: usuario.php");
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
    <title>Hobbly - Página de LogIn</title>
</head>
<body>

    <form method="POST">
        <input required type="text" name="username" placeholder="nome de usuário">
        <input required type="password" name="password" placeholder="senha">
        
        <button type="submit">Login</button>
    </form>
    
    
    
    
    <p>Não tem uma conta? registre uma <a href="register.php">aqui!</a></p>

    <?php
    if(isset($logged_in) && empty($logged_in)){
        echo "usuário ou senha estão errados, tente novamente!";
    }
    ?>
    </section>

</body>
</html>