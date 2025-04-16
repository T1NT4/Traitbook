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
        $questions = json_decode($raw_questions, true);
    ?>

    <form action="process_answer.php" method="POST">
        <?php foreach ($questions as $question): ?>
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
        <?php endforeach;?>

        <button type="submit">FINALIZR</button>
    </form>

</body>
</html>