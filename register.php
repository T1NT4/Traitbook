<?php
include_once __DIR__ . "/Controller/LoginController.php";
include_once __DIR__ . "/config.php";

$Controller = new LoginController($pdo);

if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $currentdatetime = new DateTime('now');
    $data_de_registro = $currentdatetime->format("Y-m-d H:i:s" . ".000000");

    $imagem_arquivo = $_FILES['foto-perfil'];
    include __DIR__ . '/upload-image.php';

    $cadastrou = $Controller->cadastrarConta($username, $password, $data_de_registro, $nome_arquivo_fotoperfil);
    $error_code = 0;

    if ($cadastrou && $error_code == null) {
        header("Location: login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Captura_de_tela_2024-11-11_140326-removebg-preview (1).png" type="image/png">
    <title>registrar conta</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    
            <form method="POST" enctype="multipart/form-data">
                <input required type="text" name="username" placeholder="nome de usuário">
                <input required type="password" name="password" placeholder="senha">
                <div>
                    <label for="foto-perfil">foto de perfil (opcional): </label>
                    <input type="file" name="foto-perfil" accept="image/jpg, image/jpeg, image/png">
                </div>


                <button type="submit">Cadastrar Conta</button>

        </form>


        <?php
        if (isset($cadastrou) && !$cadastrou) {
            echo "<p>esse usuário ja existe! tente outro nome de usuário.</p>";
        }
        if (isset($error_code) && $error_code != null) {
            echo $error_code;
        }
        ?>
        <p>
            Já tem uma conta?<a href="login.php">Faça login</a>
        </p>
    </section>
</body>

</html>