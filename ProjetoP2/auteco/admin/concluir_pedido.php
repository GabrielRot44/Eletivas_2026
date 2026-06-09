<?php
include("conexao.php");

$id = $_GET["id"];

$stmt = $conn->prepare("UPDATE pedidos SET status = 'concluido' WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: pedidos_hoje.php");
exit;
?>