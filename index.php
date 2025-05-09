<?php
include_once __DIR__."/Controller/LoginController.php";
include_once __DIR__."/config.php";

$Controller = new LoginController($pdo);

if(isset($_COOKIE['id_user'])){
    $user = $Controller->listarContaPorID($_COOKIE['id_user']);
    $nome_arquivo_fotoperfil = $user['nome_arquivo_fotoperfil'];
}
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
            <div  style="background-image:url('View/imgs/Banner-traitbook.png'); background-size:cover; max-width:70vw; width: 800px; aspect-ratio: 2/1;" alt="Traitbook, Descubra sua personalidade e a de seus amigos!" class="inset-shadow"></div>
            <h1 style="font-size: 3em;">Bem-vindo ao Traitbook</h1>
            <p>Descubra, entenda e compartilhe sua personalidade com o mundo. O Traitbook ajuda você a explorar traços únicos da sua identidade.</p>
            <div class="flex-row">
                <?php if(!isset($_COOKIE['id_user'])):?>
                    <a href="login.php" class="button glass"><h2>Entrar</h2></a>
                <?php else:?>
                    <a href="usuario.php" class="button glass"><h2>Página do usuário</h2></a>
                <?php endif;?>
                <a href="register.php" class="button glass"><h2>Criar Conta</h2></a>
            </div>
        </section>

        <section class=" flex-row justify-center glass">
            <div class="feature-card">
                <h3>Testes Precisos</h3>
                <p>Faça testes com base em psicologia moderna e receba resultados detalhados.</p>
            </div>
            <div class="feature-card">
                <h3>Compare com Amigos</h3>
                <p>Veja como seus traços se comparam com os de outras pessoas.</p>
            </div>
            <div class="feature-card">
                <h3>Interface Intuitiva</h3>
                <p>Explore seu perfil com uma navegação simples e visual moderna.</p>
            </div>
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
