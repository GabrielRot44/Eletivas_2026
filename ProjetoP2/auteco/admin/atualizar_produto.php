<?php
include("../includes/conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$categoria = $_POST['categoria'];

$stmt = $conn->prepare("
UPDATE produtos SET nome=?, descricao=?, preco=?, categoria=? WHERE id=?
");

$stmt->bind_param("ssdsi", $nome, $descricao, $preco, $categoria, $id);
$stmt->execute();

header("Location: cardapio.php");