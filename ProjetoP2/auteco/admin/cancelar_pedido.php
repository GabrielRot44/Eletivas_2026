<?php
include("../includes/conexao.php");

$id = $_GET["id"];

// opcional: só cancela se ainda estiver em espera
$stmt = $conn->prepare("
    UPDATE pedidos 
    SET status = 'cancelado' 
    WHERE id = ? AND status = 'em_espera'
");

$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: pedidos_hoje.php");
exit;
?>