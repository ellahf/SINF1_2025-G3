<?php
session_start();
$_SESSION['teste'] = 'funciona';

echo 'Sessão: ';
var_dump($_SESSION);
?>