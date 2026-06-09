<?php
session_start();
include("conexao.php");
$_SESSION = [];
// Destrói a sessão e redireciona para a página de login
session_destroy();
header("Location: login.php");
exit;
?>