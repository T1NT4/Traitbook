<?php
include_once __DIR__ . "/Controller/LoginController.php";
include_once __DIR__ . "/config.php";

$Controller = new LoginController($pdo);

if (!empty($_POST)) {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $genero = $_POST['gender'];
    $currentdatetime = new DateTime('now');
    $data_de_registro = $currentdatetime->format("Y-m-d H:i:s" . ".000000");
    $aniversario = $_POST['aniversario'];

    $imagem_arquivo = $_FILES['foto-perfil'];
    include __DIR__ . '/upload-image.php';

    $cadastrou = $Controller->cadastrarConta($username, $fullname, $email, $password, $data_de_registro, $nome_arquivo_fotoperfil, $aniversario, $genero);
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
                <br>
                <input required type="text" name="fullname" placeholder="nome inteiro">
                <br>
                <input required type="email" name="email" placeholder="seu e-mail">
                <br>
                <input required type="password" name="password" placeholder="senha">
                <br>
                <div style="display:flex; gap:2rem">
                    <p>Selecione seu genêro:</p>
                    <div style="display:flex">
                        <input type="radio" required name="gender" value="Male">
                        <p>Homem</p>
                    </div>
                    <div style="display:flex">
                        <input type="radio" required name="gender" value="Female">
                        <p>Mulher</p>
                    </div>
                    <div style="display:flex">
                        <input type="radio" required name="gender" value="Other">
                        <p>Outro</p>
                    </div>
                </div>
                <div>
                    <label for="aniversario">coloque sua data de nascimento (opcional):</label>
                    <input type="date" name="aniversario">
                </div>
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