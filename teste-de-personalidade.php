<?php
if(!isset($_COOKIE['id_user'])){
    header("Location: index.php");
}

include_once __DIR__."/Controller/LoginController.php";
include_once __DIR__."/config.php";

$Controller = new LoginController($pdo);
$user = $Controller->listarContaPorID($_COOKIE['id_user']);

$nome_arquivo_fotoperfil = $Controller->getFotoPerfil($user['nome_arquivo_fotoperfil'], __DIR__);

function isPortInUse($host = 'localhost', $port = 14140) {
    $connection = @fsockopen($host, $port);
    if (is_resource($connection)) {
        fclose($connection);
        return true;
    }
    return false;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traitbook - Teste de Personalidade</title>
    <link rel="stylesheet" href="View/style.css">
    <link rel="shortcut icon" href="View/imgs/logo-icon.png" type="image/x-icon">
</head>
<body>
    <?php require __DIR__.'/View/header.php';?>

    <?php
        $api_url = "http://localhost:14140/api/personality/questions";
        $flag_file = __DIR__ . '/api_server_running.flag';
        
        // Tenta acessar a API
        $raw_questions = @file_get_contents($api_url);
        
        // Se não conseguiu acessar a API
        if ($raw_questions === false) {
            // Se o servidor ainda não está iniciando, inicia o .bat
            if (!isPortInUse()) {
                if(!is_dir(__DIR__.'/../16personalities-api')){
                    pclose(popen('start /B '.__DIR__.'\batch\install_api_server.bat', 'r'));
                    
                    echo "<meta http-equiv='refresh' content='10'>";
                    echo "<h1 class='textalign-center'>Instalando o servidor 16personalities na sua máquina, aguarde...</h1>";
                    echo "<br>";
                    echo "<div class='open-server-loadbar self-align-center'></div>";
                    exit;
                }

                pclose(popen('start "Running Server" '.__DIR__.'\batch\start_api_server.bat', 'r'));
            }
        
            // Recarrega a página até o servidor estar disponível
            echo "<meta http-equiv='refresh' content='2'>";
            echo "<h1 class='textalign-center'>Aguardando servidor iniciar...</h1>";
            exit;
        }   
        
        // API respondeu com sucesso
        $questions = json_decode($raw_questions, true);
    ?>

    <form action="user-actions/process_answer.php" method="POST">
        <section>
            <div class="flex-row height-400 flex-wrap-at-760 justify-center width-100po">
                <div class="glass flex-column">
                    <?php 
                    $count = -1;
                    foreach ($questions as $question):?>
                        <?php 
                        $count += 1;
                        if($count % 2.5 == 0):?>
                            <div id="question-<?=$count/5?>" class="flex-column align-center">
                                <h1 class="textalign-center"><?=$question['text']?></h1>
                                <br>
                                <div class="flex-column align-center width-fitcontent">
                                    <div class="flex-row justify-center align-center">
                                        <?php 
                                        foreach ($question['options'] as $option): ?>
                                            <input required type="radio" name="<?=$question['id']?>" value="<?=$option['value']?>">
                                        <?php endforeach;?>
                                    </div>
                                    <div class="flex-row width-100po">
                                        <h3>Concordo</h3>
                                        <h3 class="grow-100" style="text-align: right;">Descordo</h3>
                                    </div>
                                </div>
                            </div>
                        <?php else:?>
                            <input type="hidden" name="<?=$question['id']?>" value='0'>
                        <?php endif;?>
                    <?php endforeach;?>
                    <button type="submit" class="button glass self-align-center" href="edit_perfil.php">
                        <h1>Finalizar Teste de Personalidade</h1>
                    </button>
                </div>
            </div>
        </section>
    </form>

    <div class="background" id="background">
        <div class="background-img"></div>
        <div class="background-img"></div>
    </div>
    <?php require __DIR__.'/View/footer.php';?>
    
</body>
<script src="View/js/ajustarAlturaBackground.js"></script>
</html>