<?php
include("conexao.php");

$id = $_GET["id"];

// Cancelará quando o pedido estiver em espera, ou seja, antes de ser concluído
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