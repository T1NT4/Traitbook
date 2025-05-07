<?php
include_once __DIR__."/Controller/LoginController.php";
include_once __DIR__."/Controller/ApiController.php";
include_once __DIR__."/config.php";

if(!isset($_COOKIE['id_user'])){
    header("Location: login.php");
}
$LoginController = new LoginController($pdo);

$user = $LoginController->listarContaPorID($_COOKIE['id_user']);

if($user == null){
    header("Location: user-actions/logout.php");
}

$cores = [
    'blue' => '#4297B3',
    'yellow' => '#E4AE3A',
    'green' => '#33A474',
    'purple' => '#88619A',
    'red' => '#F25E62'
];
$tem_pontos_fracos_ou_fortes = ($user['pontos_fortes'] != null) OR ($user['pontos_fortes'] != '') OR ($user['pontos_fracos'] != null) OR ($user['pontos_fracos'] != '');

$nome_arquivo_fotoperfil = $user['nome_arquivo_fotoperfil'];
if(!isset($user['nome_arquivo_fotoperfil'])){
    $nome_arquivo_fotoperfil = '../imgs/DefaultPFP.png';
}

if($user['pontos_fracos'] != null OR $user['pontos_fracos'] != ''){
    $pontos_fracos = json_decode($user['pontos_fracos'], true);
}else{
    $pontos_fracos = ['','','',''];
}


if($user['pontos_fortes'] != null OR $user['pontos_fortes'] != ''){
    $pontos_fortes = json_decode($user['pontos_fortes'], true);
}else{
    $pontos_fortes = ['','','',''];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário</title>
    <link rel="stylesheet" href="View/style.css">
    <link rel="shortcut icon" href="View/imgs/logo-icon.png" type="image/x-icon">
</head>
<body>
    <header>
        <a class="logo" href="index.php">
            <img src="View/imgs/Logo-Traitbook.svg">
        </a>
        <div class="flex-row align-center gap30">
            <div class="pfp mini">
                <img src="View/fotos_de_perfil/<?=$nome_arquivo_fotoperfil?>">
            </div>
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
    <form method="POST">
    <section>
        <div class="flex-row height-400 flex-wrap-at-760 ">
            <div class="glass width-100po flex-row align-start flex-column-at-760 width-150po">
                <div class="pfp">
                    <?php if(isset($user)):?>
                        <img src="View/fotos_de_perfil/<?=$nome_arquivo_fotoperfil?>">
                    <?php endif;?>
                </div>
                <br>
                <div class="flex-column nogap grow-100" style="width: -webkit-fill-available">
                    <h3>Nome de usuário:</h3>
                    <input type="text" value="<?=$user['username']?>" name='username'>
                    <br>
                    <h3>Nome:</h3>
                    <input type="text" value="<?=$user['nome_inteiro']?>" name='nome_inteiro'>
                    <br>
                    <h3>Email:</h3>
                    <input type="text" value="<?=$user['email']?>" name='email'>
                    <br>
                    <h3>Genêro:</h3>
                    <!-- <h1><?=$genero_pt[$user['genero']]?></h1> -->
                    <div class="select-container">
                        <select name="genero">
                            <option value="Male">Homem</option>
                            <option value="Male">Mulher</option>
                            <option value="Male">Outro</option>
                        </select>
                        <p>v</p>
                    </div>
                    <br>
                    <h3>Data de nascimento:</h3>
                    <input type="date" name="aniversario" value="<?=$user['aniversario']?>">
                    <br>
                    <div class="flex-row gap10 self-align-center">
                        <a class="button glass self-align-center" href="edit_perfil.php">
                            <h1>Concluir edição de perfil</h1>
                        </a>
                    </div>
                </div>
            </div>
                <div class="glass flex-column width-100po">
                    <h1>Sobre mim:</h1>
                    <textarea name="sobre_mim"><?=$user['sobre_mim']?></textarea>
                </div>
                </div>
       
            <div class="flex-row height-200 flex-wrap-at-760">
                <div class="glass width-100po flex-column">
                    <h1>Pontos fortes:</h1>
                    <div class="flex-row align-center">
                        <h3>-</h3>
                        <input type="text" class="grow-100 smallinput" placeholder="Ponto forte 1" value="<?=$pontos_fortes[0]?>">
                    </div>
                    <div class="flex-row align-center">
                        <h3>-</h3>
                        <input type="text" class="grow-100 smallinput" placeholder="Ponto forte 2" value="<?=$pontos_fortes[1]?>">
                    </div>
                    <div class="flex-row align-center">
                        <h3>-</h3>
                        <input type="text" class="grow-100 smallinput" placeholder="Ponto forte 3" value="<?=$pontos_fortes[2]?>">
                    </div>
                    <div class="flex-row align-center">
                        <h3>-</h3>
                        <input type="text" class="grow-100 smallinput" placeholder="Ponto forte 4" value="<?=$pontos_fortes[3]?>">
                    </div>
                </div>
                <div class="glass width-100po flex-column">
                    <h1>Pontos fracos:</h1>
                    <div class="flex-row align-center">
                        <h3>-</h3>
                        <input type="text" class="grow-100 smallinput" placeholder="Ponto fraco 1" value="<?=$pontos_fracos[0]?>">
                    </div>
                    <div class="flex-row align-center">
                        <h3>-</h3>
                        <input type="text" class="grow-100 smallinput" placeholder="Ponto fraco 2" value="<?=$pontos_fracos[0]?>">
                    </div>
                    <div class="flex-row align-center">
                        <h3>-</h3>
                        <input type="text" class="grow-100 smallinput" placeholder="Ponto fraco 3" value="<?=$pontos_fracos[0]?>">
                    </div>
                    <div class="flex-row align-center">
                        <h3>-</h3>
                        <input type="text" class="grow-100 smallinput" placeholder="Ponto fraco 4" value="<?=$pontos_fracos[0]?>">
                    </div>
                </div>
            </div>
        <div class="flex-row height-500 flex-wrap-at-1000">
            <div class="width-100po flex-column">
                
                <div class="glass grow-100 flex-column">
                    <h1>Profissão atual:</h1>
                    <p><?=$user['profissao_atual']?></p>
                </div>
                <div class="glass grow-100 flex-column">
                    <h1>Minhas aspirações:</h1>
                    <p><?=$user['minhas_aspiracoes']?></p>
                </div>
                <div class="glass grow-100 flex-column">
                    <h1>Meus principais objetivos:</h1>
                    <p><?=$user['meus_principais_objetivos']?></p>
                </div>
            </div>
        </div>
    </section>
    </form>
    <div class="background" id="background">
        <div class="background-img"></div>
        <div class="background-img"></div>
    </div>
    <div class="footer-margin"></div>
    <footer>
        <p>Todos direitos reservados © Traitbook 2025</p>
    </footer>
</body>
</html>
<script>
    var body = document.body;
    var html = document.documentElement;

    var height = Math.max(
        body.scrollHeight,
        body.offsetHeight,
        html.clientHeight,
        html.scrollHeight,
        html.offsetHeight
    );

    document.getElementById('background').style.height = height.toString()+"px"

</script>    
<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.7.5/lottie.min.js"></script>
<script src="handleLottieAnim.js"></script>
<script>
    initAnim('<?=$jsonAnim?>');
</script>