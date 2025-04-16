<?php
if(isset($_COOKIE['id_user'])){
    header("Location: teste-de-personalidade.php");
}else{
    header("Location: login.php");
}
?>