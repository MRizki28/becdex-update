<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core;

$idUser = $core->data->real_escape_string($_COOKIE['idUser']);
$core->data->query("UPDATE tb_users SET `key` = NULL WHERE idUser = '$idUser'");
$core->data->close();

if(isset($_SERVER['HTTP_COOKIE'])){
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie){
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time() - 3600, '/', $_SERVER['SERVER_NAME'], false, true);
    }
}

header("Location: ".urlFlex);