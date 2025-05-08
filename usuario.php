<?php
include_once __DIR__."/Controller/LoginController.php";
include_once __DIR__."/Controller/ApiController.php";
include_once __DIR__."/config.php";

if(!isset($_COOKIE['id_user'])){
    header("Location: login.php");
}
$ApiController = new ApiController();
$LoginController = new LoginController($pdo);

$user = $LoginController->listarContaPorID($_COOKIE['id_user']);

if($user == null){
    header("Location: user-actions/logout.php");
}

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
$data_de_criacao = new DateTimeImmutable($user['data_de_registro']);
$data_de_agora = new DateTimeImmutable('now');
$horas_desde_conta_criada = ($data_de_agora->getTimestamp() - $data_de_criacao->getTimestamp()) / 3600;

$cores = [
    'blue' => '#4297B3',
    'yellow' => '#E4AE3A',
    'green' => '#33A474',
    'purple' => '#88619A',
    'red' => '#F25E62'
];
$tem_pontos_fortes = (($user['pontos_fortes'] == null) OR ($user['pontos_fortes'] == '') OR ($user['pontos_fortes'] == '["","","",""]'));
$tem_pontos_fracos = (($user['pontos_fracos'] == null) OR ($user['pontos_fracos'] == '') OR ($user['pontos_fracos'] == '["","","",""]'));
$tem_pontos_fracos_ou_fortes = $tem_pontos_fracos OR $tem_pontos_fortes;

$pontos_fortes = ['','','',''];

if(!$tem_pontos_fortes){
    $pontos_fortes = json_decode($user['pontos_fortes'], true);
}

$pontos_fracos = ['','','',''];

if(!$tem_pontos_fracos){
    $pontos_fracos = json_decode($user['pontos_fracos'], true);
}

$nome_arquivo_fotoperfil = $user['nome_arquivo_fotoperfil'];
if(!isset($user['nome_arquivo_fotoperfil'])){
    $nome_arquivo_fotoperfil = '../imgs/DefaultPFP.png';
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
    <?php require __DIR__.'/View/header.php'?>
    <section>
        <div class="flex-row height-400 flex-wrap-at-760">
            <div class="glass width-150po flex-row align-start flex-column-at-760">
                <div class="pfp">
                    <?php if(isset($user)):?>
                        <img src="View/fotos_de_perfil/<?=$nome_arquivo_fotoperfil?>">
                    <?php endif;?>
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
                    <div class="flex-row gap10 self-align-center">
                        <a class="button glass self-align-center" href="edit_perfil.php">
                            <h1>Editar Perfil</h1>
                        </a>
                        <a class="button glass self-align-center" href="user-actions/logout.php">
                            <h1>Sair da conta</h1>
                        </a>
                    </div>
                </div>
            </div>
            <?php if(!(($user['sobre_mim'] == null) OR ($user['sobre_mim'] == ''))):?>
                <div class="glass flex-column width-100po">
                    <h1>Sobre mim:</h1>
                    <p>
                        <?=$user['sobre_mim']?>
                    </p>
                </div>
            <?php else:?>
                <?php if($horas_desde_conta_criada < 2):?>
                    <div class="glass flex-column width-100po justify-center">
                        <h1 class="textalign-center">Parece que você acabou de criar a conta, personalise ela um pouco! clique em "Editar Perfil" para começar.</h1>
                    </div>
                <?php endif;?>
            <?php endif;?>
                </div>
        <?php if(!$tem_pontos_fracos_ou_fortes):?>
            <div class="flex-row height-200 flex-wrap-at-760">
                <?php if(!$tem_pontos_fortes):?>
                    <div class="glass width-100po flex-column">
                        <h1>Pontos fortes:</h1>
                        <?php foreach($pontos_fortes as $ponto_forte):?>
                            <?php if($ponto_forte != ''):?>
                                <h3>-<?=$ponto_forte?></h3>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>
                <?php endif;?>
                <?php if(!$tem_pontos_fracos):?>
                    <div class="glass width-100po flex-column">
                    <h1>Pontos fracos:</h1>
                        <?php foreach($pontos_fracos as $ponto_fraco): ?>
                            <?php if($ponto_fraco != ''):?>
                                <h3>-<?=$ponto_fraco?></h3>
                            <?php endif;?>
                        <?php endforeach;?>
                </div>
                <?php endif;?>
            </div>
        <?php endif;?>
        <div class="flex-row height-500 flex-wrap-at-1000">
            <?php if((!(($user['profissao_atual'] == null) OR ($user['profissao_atual'] == ''))) OR
                     (!(($user['minhas_aspiracoes'] == null) OR ($user['minhas_aspiracoes'] == ''))) OR
                     (!(($user['meus_principais_objetivos'] == null) OR ($user['meus_principais_objetivos'] == '')))):?>
            <div class="width-100po flex-column">
                <?php if(!(($user['profissao_atual'] == null) OR ($user['profissao_atual'] == ''))):?>
                <div class="glass grow-100 flex-column">
                    <h1>Profissão atual:</h1>
                    <p><?=$user['profissao_atual']?></p>
                </div>
                <?php endif;?>
                <?php if(!(($user['minhas_aspiracoes'] == null) OR ($user['minhas_aspiracoes'] == ''))):?>
                <div class="glass grow-100 flex-column">
                    <h1>Minhas aspirações:</h1>
                    <p><?=$user['minhas_aspiracoes']?></p>
                </div>
                <?php endif;?>
                <?php if(!(($user['meus_principais_objetivos'] == null) OR ($user['meus_principais_objetivos'] == ''))):?>
                <div class="glass grow-100 flex-column">
                    <h1>Meus principais objetivos:</h1>
                    <p><?=$user['meus_principais_objetivos']?></p>
                </div>
                <?php endif;?>
            </div>
            <?php endif;?>
            <?php if($personalidade != null):?>
                <div class="glass width-200po flex-row flex-wrap-at-760">
                    <div class="flex-column width-100po">
                        <h1>Personalidade: <?=$personalidade['personalityShort']?></h1>
                        <div id="lottie-animation" style="width:400px; max-width: 75vw;">
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
                            <a class="button glass self-align-center" href="teste-de-personalidade.php">
                                <h1>Refazer teste de personalidade</h1>
                            </a>
                        </div>
                    </div>
                </div>
            <?php else:?>
                <div class="glass width-100po justify-center flex-row">
                    <a class="button glass self-align-center" href="teste-de-personalidade.php">
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
    <?php require __DIR__.'/View/footer.php'?>
</body>
</html>
<script src="View/js/ajustarAlturaBackground.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.7.5/lottie.min.js"></script>
<script src="View/js/handleLottieAnim.js"></script>
<script>
    initAnim('<?=$jsonAnim?>');
</script>