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
    <title>Traitbook - Usuário</title>
    <link rel="stylesheet" href="View/style.css">
    <link rel="shortcut icon" href="View/imgs/logo-icon.png" type="image/x-icon">
</head>
<body>
    <?php require __DIR__.'/View/header.php'?>
    <form method="POST" action="user-actions/process_edit_perfil.php" enctype="multipart/form-data">
    <section>
        <div class="flex-row height-400 flex-wrap-at-760 ">
            <div class="glass width-100po flex-row align-start flex-column-at-760 width-150po">
                <div class="pfp">
                    <?php if(isset($user)):?>
                        <img src="View/fotos_de_perfil/<?=$nome_arquivo_fotoperfil?>">
                    <?php endif;?>
                    <label for="foto_perfil">
                        <img src="View/imgs/mudarFotoPerfil.png" alt="">
                    </label>
                    <input type="file" name="foto_perfil" id="foto_perfil" onchange="this.form.submit()">
                </div>
                <br>
                <div class="flex-column nogap grow-100" style="width: -webkit-fill-available">
                    <?php if(isset($_COOKIE['edit_perfil_error_code'])):?>
                        <h1><?=$_COOKIE['edit_perfil_error_code']?></h1>
                    <?php endif;?>
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
                            <option value="Male" <?php if($user['genero'] == 'Male'): echo 'selected'; endif;?>>Homem</option>
                            <option value="Female" <?php if($user['genero'] == 'Female'): echo 'selected'; endif;?>>Mulher</option>
                            <option value="Other" <?php if($user['genero'] == 'Other'): echo 'selected'; endif;?>>Outro</option>
                        </select>
                        <p>v</p>
                    </div>
                    <br>
                    <h3>Data de nascimento:</h3>
                    <input type="date" name="aniversario" value="<?=$user['aniversario']?>">
                    <br>
                    <div class="flex-row gap10 self-align-center">
                        <button type="submit" class="button glass self-align-center" href="edit_perfil.php">
                            <h1>Concluir edição de perfil</h1>
                        </button>
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
                        <input type="text" class="grow-100 smallinput" placeholder="Ponto forte 1" value="<?=$pontos_fortes[0]?>" name="pontos_fortes0">
                    </div>
                    <div class="flex-row align-center">
                        <h3>-</h3>
                        <input type="text" class="grow-100 smallinput" placeholder="Ponto forte 2" value="<?=$pontos_fortes[1]?>" name="pontos_fortes1">
                    </div>
                    <div class="flex-row align-center">
                        <h3>-</h3>
                        <input type="text" class="grow-100 smallinput" placeholder="Ponto forte 3" value="<?=$pontos_fortes[2]?>" name="pontos_fortes2">
                    </div>
                    <div class="flex-row align-center">
                        <h3>-</h3>
                        <input type="text" class="grow-100 smallinput" placeholder="Ponto forte 4" value="<?=$pontos_fortes[3]?>" name="pontos_fortes3">
                    </div>
                </div>
                <div class="glass width-100po flex-column">
                    <h1>Pontos fracos:</h1>
                    <div class="flex-row align-center">
                        <h3>-</h3>
                        <input type="text" class="grow-100 smallinput" placeholder="Ponto fraco 1" value="<?=$pontos_fracos[0]?>" name="pontos_fracos0">
                    </div>
                    <div class="flex-row align-center">
                        <h3>-</h3>
                        <input type="text" class="grow-100 smallinput" placeholder="Ponto fraco 2" value="<?=$pontos_fracos[1]?>" name="pontos_fracos1">
                    </div>
                    <div class="flex-row align-center">
                        <h3>-</h3>
                        <input type="text" class="grow-100 smallinput" placeholder="Ponto fraco 3" value="<?=$pontos_fracos[2]?>" name="pontos_fracos2">
                    </div>
                    <div class="flex-row align-center">
                        <h3>-</h3>
                        <input type="text" class="grow-100 smallinput" placeholder="Ponto fraco 4" value="<?=$pontos_fracos[3]?>" name="pontos_fracos3">
                    </div>
                </div>
            </div>
        <div class="flex-row height-500 flex-wrap-at-1000">
            <div class="width-100po flex-column">
                
                <div class="glass grow-100 flex-column">
                    <h1>Profissão atual:</h1>
                    <input type="text" class="grow-100 smallinput height-100po-2" value="<?=$user['profissao_atual']?>" name="profissao_atual">
                </div>
                <div class="glass grow-100 flex-column">
                    <h1>Minhas aspirações:</h1>
                    <input type="text" class="grow-100 smallinput height-100po-2" value="<?=$user['minhas_aspiracoes']?>" name="minhas_aspiracoes">
                </div>
                <div class="glass grow-100 flex-column">
                    <h1>Meus principais objetivos:</h1>
                    <input type="text" class="grow-100 smallinput height-100po-2" value="<?=$user['meus_principais_objetivos']?>" name="meus_principais_objetivos">
                </div>
            </div>
        </div>
    </section>
    </form>
    <div class="background" id="background">
        <div class="background-img"></div>
        <div class="background-img"></div>
    </div>
    <?php require __DIR__.'/View/footer.php'?>
</body>
</html>
<script src="View/js/ajustarAlturaBackground.js"></script>