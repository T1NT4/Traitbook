<header>
    <a class="logo" href="index.php">
        <img src="View/imgs/Logo-Traitbook.svg">
    </a>
    <div class="flex-row align-center gap30">
        <?php if(isset($nome_arquivo_fotoperfil)):?>
            <a class="pfp mini" href="usuario.php">
                <img src="View/fotos_de_perfil/<?=$nome_arquivo_fotoperfil?>">
            </a>
        <?php endif;?>
        <input type="checkbox" class='display-none' id="hamburger-checkbox">
        <label for="hamburger-checkbox" id="hamburger">☰</label>
    </div>
    <nav class="glass">
        <div class="nav-element">
            <a href="">Página inicial</a>
        </div>
        <div class="nav-element">
            <a href="">Página inicial</a>
        </div>
        <div class="nav-element">
            <a href="">Página inicial</a>
        </div>
    </nav>
</header>