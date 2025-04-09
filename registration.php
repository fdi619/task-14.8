<?php
$login = $_POST['login'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$userArr = [["login" => $login, "password" => $password]];

header('Location: /index.php');

?>