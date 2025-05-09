<?php
require_once __DIR__."/../config.php";
require_once __DIR__."/../Controller/LoginController.php";

$Controller = new LoginController($pdo);
$user = $Controller->listarContaPorID($_COOKIE['id_user']);

$gender = $user['genero'];
$answers = [];

foreach($_POST as $key => $value){
    if($key != "gender"){
        array_push($answers,[
            "id" => $key,
            "value" => intval($value)
        ]);
    }
}

$final_result = [
    "answers" => $answers,
    "gender" => $gender
];

$url = "http://localhost:14140/api/personality/submit";
// Initialize cURL session
$ch = curl_init($url);

// Setup request
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($final_result));

// Execute request
$responseraw = curl_exec($ch);


// Close session
curl_close($ch);

$response = json_decode($responseraw,true);

require_once __DIR__."/../config.php";
require_once __DIR__."/../Controller/LoginController.php";
require_once __DIR__."/../Controller/ApiController.php";

$LoginController = new LoginController($pdo);
$ApiController= new ApiController();

$personalidade = $ApiController->getDataFrom16PersonalitiesLink($response['ogLink']);
$personalidade_data = json_encode($personalidade);

$LoginController->updateLinkPersonalidade($_COOKIE['id_user'],$response['ogLink'], $personalidade_data);

header("Location: ../usuario.php");
?>

<!-- 
FOTINHA DO PERSONAGEM EM PÉ
<img src="<?=$data['details']['cards']['personality']['imageSrc']?>" alt="<?=$data['details']['cards']['personality']['imageAlt']?>" width="200">
NOME DA PERSONALIDADE
<p><?=$data['personalityShort']?></p> -->
