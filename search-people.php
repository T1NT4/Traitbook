<?php
include_once __DIR__."/Controller/LoginController.php";
include_once __DIR__."/config.php";

$Controller = new LoginController($pdo);

if(isset($_COOKIE['id_user'])){
    $user = $Controller->listarContaPorID($_COOKIE['id_user']);
    $nome_arquivo_fotoperfil = $user['nome_arquivo_fotoperfil'];
}

$allusers = $Controller->listarContaTodas();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traitbook - Descubra sua personalidade</title>
    <link rel="stylesheet" href="View/style.css">
    <link rel="shortcut icon" href="View/imgs/logo-icon.png" type="image/x-icon">
</head>
<body>

    <?php include __DIR__."/View/header.php";?>

    <section class="flex-column gap30">
        <section class="hero-section flex-column align-center justify-center glass">
            <input type="text" id="pesquisar" placeholder="Pesquise alguém!" class="width-500 maxwidth90">
        </section>

        <section class=" flex-row justify-center glass maxheight-600">
            <?php foreach($allusers as $user): ?>
                <div class="glass flex-row">
                    <?php
                        if(!isset($user['nome_arquivo_fotoperfil'])){
                            $nome_arquivo_fotoperfil = '../imgs/DefaultPFP.png';
                        }
                    ?>
                </div>
            <?php endforeach;?>
        </section>
    </section>

    <div class="background" id="background">
        <div class="background-img"></div>
        <div class="background-img"></div>
    </div>
    
    <?php include __DIR__."/View/footer.php";?>

    <script src="View/js/ajustarAlturaBackground.js"></script>
</body>
</html>
