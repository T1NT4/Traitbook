<?php
if(!isset($_COOKIE['id_user'])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de Personalidae</title>
</head>
<body>
    <?php
        $raw_questions = file_get_contents("http://localhost:14140/api/personality/questions");
        if($raw_questions == false){
            $api_dir = __DIR__;
            $api_dir = str_replace('traitbook','16personalities-api',$api_dir);
            var_dump($api_dir);

            system('cd '.$api_dir.' && npm run dev');
            header('Location: teste-de-personalidade.php');
        }

        $questions = json_decode($raw_questions, true);
    ?>

    <form action="user-actions/process_answer.php" method="POST">
        <?php 
        $count = 1;
        foreach ($questions as $question):?>
            <?php 
            $count += 1;
            if($count % 5 == 0):?>
                <h3><?=$question['text']?></h3>
                <div style="display:flex; gap:2rem">
                    <?php 
                    $random = rand(-2,2);
                    foreach ($question['options'] as $option): ?>
                    <div style="display:flex">
                        <input required type="radio" name="<?=$question['id']?>" value="<?=$option['value']?>" <?php if($random==$option['value']){echo "checked";}?>>
                        <p><?=$option['text']?></p>
                    </div>
                    <?php endforeach;?>
                </div>
            <?php else:?>
                <input type="hidden" name="<?=$question['id']?>" value='0'>
            <?php endif;?>
        <?php endforeach;?>
        <button type="submit">FINALIZR</button>
    </form>

</body>
</html>