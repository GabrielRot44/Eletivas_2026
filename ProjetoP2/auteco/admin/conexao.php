<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "restaurante";
// Conexão com o banco de dados 
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>