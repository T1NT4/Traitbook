<?php

$gender = $_POST['gender'];
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

$raw_page = file_get_contents($response["ogLink"]);

$start_name_needle = '<meta property="og:title" content="';
$loc_start_name = strpos($raw_page,$start_name_needle);

$name_with_rest_of_page = substr($raw_page, $loc_start_name+strlen($start_name_needle));

$loc_start_classification = strpos($name_with_rest_of_page,'(');

$niceName = substr($name_with_rest_of_page, 0, $loc_start_classification-1);




$start_data_needle = ':data="';
$loc_start_data =  strpos($raw_page,$start_data_needle);

$data_with_rest_of_page = substr($raw_page, $loc_start_data+strlen($start_data_needle));

$loc_start_rest_of_page = strpos($data_with_rest_of_page,'fullTypeHtml');

$data_raw = substr($data_with_rest_of_page, 0, $loc_start_rest_of_page-7);
$data_raw = $data_raw. "}";
$data_raw = html_entity_decode($data_raw);


$data = json_decode($data_raw, true, 512, JSON_THROW_ON_ERROR);

?>

<p></p>
<p><?=$niceName?></p>

