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

    if($_FILES['foto-perfil']['name'] != ''){
        $imagem_arquivo = $_FILES['foto-perfil'];
        include __DIR__ . '/upload-image.php';
    }
    else{
        $nome_arquivo_fotoperfil = null;
    }

    $cadastrou = $Controller->cadastrarConta($username, $fullname, $email, $password, $data_de_registro, $nome_arquivo_fotoperfil, $aniversario, $genero);
    $error_code = 0;

    if ($cadastrou && $error_code == null) {
        header('Location: login.php');
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
    <title>Traitbook - Cadastrar conta</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="View/style.css">
    <link rel="shortcut icon" href="View/imgs/logo-icon.png" type="image/x-icon">
</head>

<body>

    <?php include __DIR__."/View/header.php";?>

    
        <form method="POST" enctype="multipart/form-data">
            <section>
                <div class="flex-row flex-wrap-at-760 justify-center">
                    <div class="glass flex-column  flex-column-at-760 align-center">
                        <?php if(isset($cadastrou) && !$cadastrou):?>
                            <h3 class="textalign-center">Este Nome de Usuário ou Email ja está sendo usado, tente novamente!.</h3>
                        <?php endif;?>
                        <?php if(isset($error_code) && $error_code != null):?>
                            <h3 class="textalign-center"><?=$error_code?></h3>
                        <?php endif;?>
                        <div>
                            <h3>Nome de usuário:</h3>
                            <input required class=' minwidth-300' type="text" name="username" placeholder="nome de usuário">
                        </div>
                        <div>
                            <h3>Nome inteiro:</h3>
                            <input required class=' minwidth-300' type="text" name="fullname" placeholder="nome inteiro">
                        </div>
                        <div>
                            <h3>Email:</h3>
                            <input required class=' minwidth-300' type="email" name="email" placeholder="seu e-mail">
                        </div>
                        <div>
                            <h3>Senha:</h3>
                            <input required class=' minwidth-300' type="password" name="password" placeholder="senha">
                        </div>
                        <div>
                            <h3>Selecione o seu genêro:</h3>
                            <div class="flex-row align-center gap10">
                                <div class="flex-row align-center gap5">
                                    <input type="radio" class="smallradio" required name="gender" value="Male" id="Male">
                                    <label for="Male"><p>Homem</p></label>
                                </div>
                                <div class="flex-row align-center gap5">
                                    <input type="radio" class="smallradio" required name="gender" value="Female" id="Female">
                                    <label for="Female"><p>Mulher</p></label>
                                </div>
                                <div class="flex-row align-center gap5">
                                    <input type="radio" class="smallradio" required name="gender" value="Other" id="Other">
                                    <label for="Other"><p>Outro</p></label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="aniversario"><h3>Data de nascimento (opcional):</h3></label>
                            <input class=' minwidth-300' type="date" name="aniversario" id="aniversario">
                        </div>
                        <div>
                            <label for="foto-perfil"><h3>Foto de perfil (opcional): </h3></label>
                            <input type="file" id="foto-perfil" name="foto-perfil" accept="image/jpg, image/jpeg, image/png">
                        </div>



                        <button type="submit" class="button glass self-align-center"><h1>Cadastrar Conta</h1></button>


                        <p class="textalign-center">Já tem uma conta?<a href="login.php">Faça login</a></p>
                        
                    </div>
                </div>
            </section>
        </form>
    </section>
   <div class="background" id="background">
        <div class="background-img"></div>
        <div class="background-img"></div>
    </div>
    <?php include __DIR__."/View/footer.php";?>

</body>
<script src="View/js/ajustarAlturaBackground.js"></script>

</html>