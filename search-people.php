<?php
include_once __DIR__."/Controller/LoginController.php";
include_once __DIR__."/config.php";

$Controller = new LoginController($pdo);

if(isset($_COOKIE['id_user'])){
    $user = $Controller->listarContaPorID($_COOKIE['id_user']);
    $nome_arquivo_fotoperfil = $Controller->getFotoPerfil($user['nome_arquivo_fotoperfil'], __DIR__);
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
            <input type="text" id="pesquisar" placeholder="Pesquise alguém!" class="width-500 maxwidth90" onchange="searchuser()">
        </section>

        <section class="flex-row justify-center glass" id="allusers">
            <?php foreach($allusers as $display_user): ?>
                <a class="glass flex-row link-user" href="usuario.php?view_username=<?=$display_user['username']?>">
                    <?php
                        $display_nome_arquivo_fotoperfil = $Controller->getFotoPerfil($display_user['nome_arquivo_fotoperfil'], __DIR__);
                    ?>
                    <div class="pfp">
                        <img src="View/fotos_de_perfil/<?=$display_nome_arquivo_fotoperfil?>">
                    </div>
                    <div class="flex-column gap10">
                        <h1 id="nome_inteiro"><?=$display_user['nome_inteiro']?></h1>
                        <h3><?=$display_user['profissao_atual']?></h3>
                    </div>
                </a>
            <?php endforeach;?>
            <!-- ?view_user_id=123 -->
        </section>
    </section>

    <div class="background" id="background">
        <div class="background-img"></div>
        <div class="background-img"></div>
    </div>
    
    <?php include __DIR__."/View/footer.php";?>

    <script src="View/js/ajustarAlturaBackground.js"></script>
    <script>
        function searchuser(){
            allusers = document.getElementById('allusers').children;
            value = document.getElementById('pesquisar').value;

            allusers = Array.from(allusers)

            allusers.forEach(element => {
                nome_inteiro = element.children[1].children[0].innerHTML
                if(!nome_inteiro.toLowerCase().includes(value.toLowerCase())){
                    element.style = 'display:none';
                }else{
                    element.style = '';
                }
            });
        }
    </script>
</body>
</html>
