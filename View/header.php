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
        <a class="nav-element" href="index.php">
            <p>Página inicial</p>
        </a>
        <a class="nav-element" href="search-people.php">
            <p>Buscar pessoas</p>
        </a>
        <?php if(isset($_COOKIE['id_user'])):?>
            <a href="usuario.php" class="nav-element">
                <p>Página do usuário</p>
            </a>
        <?php endif;?>
    </nav>
</header>