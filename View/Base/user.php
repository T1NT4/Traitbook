<?php
include_once __DIR__."/../../Controller/LoginController.php";
include_once __DIR__."/../../Controller/ApiController.php";
include_once __DIR__."/../../config.php";

if(!isset($_COOKIE['id_user'])){
    header("Location: ../../login.php");
}
$ApiController = new ApiController();
$LoginController = new LoginController($pdo);

$user = $LoginController->listarContaPorID($_COOKIE['id_user']);



if ($user['link_personalidade'] == ""){
    $personalidade = null;    
}else{
    $personalidade = $ApiController->getDataFrom16PersonalitiesLink($user['link_personalidade']);
    $jsonAnim = file_get_contents($personalidade['avatar']['staticBodyJson']);
    $svgData = file_get_contents($personalidade['avatar']['staticBodyPath']);

}


$genero_pt = [
    'Female' => 'Mulher',
    'Male' => 'Homem',
    'Other' => 'Outro'
];
$aniversario = new DateTime($user['aniversario']);
$cores = [
    'blue' => '#4297B3',
    'yellow' => '#E4AE3A',
    'green' => '#33A474',
    'purple' => '#88619A',
    'red' => '#F25E62'
];
$tem_pontos_fracos_ou_fortes = (($user['pontos_fortes'] != null) OR ($user['pontos_fortes'] != '')) OR (($user['pontos_fracos'] != null) OR ($user['pontos_fracos'] != ''));

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../imgs//Logo-Traitbook.svg">
        </div>
        <div class="pfp mini">
            <img src="../fotos_de_perfil/<?=$user['nome_arquivo_fotoperfil']?>">
        </div>
    </header>
    <section>
        <div class="flex-row height-400 flex-wrap-at-760">
            <div class="glass width-150po flex-row align-start ">
                <div class="pfp">
                    <img src="../fotos_de_perfil/<?=$user['nome_arquivo_fotoperfil']?>">
                </div>
                <br>
                <div class="flex-column nogap grow-100">
                    <h3>Nome de usuário:</h3>
                    <h1><?=$user['username']?></h1>
                    <br>
                    <h3>Nome:</h3>
                    <h1><?=$user['nome_inteiro']?></h1>
                    <br>
                    <h3>Email:</h3>
                    <h1><?=$user['email']?></h1>
                    <br>
                    <h3>Genêro:</h3>
                    <h1><?=$genero_pt[$user['genero']]?></h1>
                    <br>
                    <h3>Data de nascimento:</h3>
                    <h1><?=$aniversario->format('d/m/Y')?></h1>
                    <br>
                    <a class="button glass self-align-center" href="edit_perfil.php">
                        <h1>Editar Perfil</h1>
                    </a>
                </div>
            </div>
            <div class="glass flex-column width-100po">
                <h1>Sobre mim:</h1>
                <p>
                    <?=$user['sobre_mim']?>
                </p>
          </div>
        </div>
        <?php if($tem_pontos_fracos_ou_fortes):?>
            <div class="flex-row height-200 flex-wrap-at-760">
                <div class="glass width-100po flex-column">
                    <h1>Pontos fortes:</h1>
                    <h3>-Handsome</h3>
                    <h3>-Handsome</h3>
                    <h3>-Handsome</h3>
                    <h3>-Handsome</h3>
                </div>
                <div class="glass width-100po flex-column">
                    <h1>Pontos fracos:</h1>
                    <h3>-Só apareco por 1 minuto no jogo</h3>
                </div>
            </div>
        <?php endif;?>
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
            <?php if($personalidade != null):?>
                <div class="glass width-200po flex-row flex-wrap-at-760">
                    <div class="flex-column width-100po">
                        <h1>Personalidade: <?=$personalidade['personalityShort']?></h1>
                        <div id="lottie-animation" style="width:400px">
                            <?=$svgData?>
                        </div>
                        <a target="_blank" href="<?=$user['link_personalidade']?>">Link da personalidade no site oficial da 16Personalities</a>
                        <a target="_blank" href="<?=$personalidade['personalityLink']?>">Saiba mais sobre essa personalidade no site 16Personalities</a>
                    </div>
                    <div class="flex-column width-150po">
                        <div class="flex-column grow-100 width-100po" style="justify-content: center; gap:30px">
                            <?php foreach($personalidade['details']['traits'] as $trait):?>
                                <div class="flex-column nogap">
                                    <h3><?=$trait['pct']. "% " . $trait['trait']?></h3>
                                    <div class="glass width-100po height-15 flex-column nopadding overflow-h">
                                        <?php if($trait['reversed'] == 1):?>
                                            <div class="height-100po" style="width: <?=$trait['pct']?>%; background-color: <?=$cores[$trait['color']]?>;"></div>
                                        <?php else: $reversepct = ($trait['pct']-100)*-1?>
                                            <div class="height-100po" style="width: <?=$reversepct?>%; background-color: <?=$cores[$trait['color']]?>;"></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-row">
                                        <p><?=$trait['titles'][0]?></p>
                                        <p class="grow-100" style="text-align: right;"><?=$trait['titles'][1]?></p>
                                    </div>
                                </div>
                            <?php endforeach;?>
                            <a class="button glass self-align-center" href="../../teste-de-personalidade.php">
                                <h1>Refazer teste de personalidade</h1>
                            </a>
                        </div>
                    </div>
                </div>
            <?php else:?>
                <div class="glass width-100po justify-center flex-row">
                    <a class="button glass self-align-center" href="../../teste-de-personalidade.php">
                        <h1>Fazer o teste de personalidade</h1>
                    </a>
                </div>
            <?php endif;?>
        </div>
    </section>
    <div class="background" id="background">
        <div class="background-img"></div>
        <div class="background-img"></div>
    </div>
    
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
<script src="../../handleLottieAnim.js"></script>
<script>
    initAnim('<?=$jsonAnim?>');
</script>