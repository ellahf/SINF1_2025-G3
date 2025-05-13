<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$bd_host = "localhost";
$bd_user = "root";
$bd_password = "";
$bd_database = "sinf1_g3";

$mysqli = new mysqli($bd_host, $bd_user, $bd_password, $bd_database);

if ($mysqli->connect_error) {
    die("Erro na conexão: " . $mysqli->connect_error);
}
?>