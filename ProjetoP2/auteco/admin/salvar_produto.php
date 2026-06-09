<?php
include("conexao.php");

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$categoria = $_POST['categoria'];

$imagem_nome = $_FILES['imagem']['name'];
$tmp = $_FILES['imagem']['tmp_name'];

$caminho = "uploads/" . time() . "_" . $imagem_nome;

move_uploaded_file($tmp, "../" . $caminho);


$stmt = $conn->prepare("
INSERT INTO produtos (nome, descricao, preco, categoria, imagem)
VALUES (?, ?, ?, ?, ?)
");

$stmt->bind_param("ssdss", $nome, $descricao, $preco, $categoria, $caminho);
$stmt->execute();

header("Location: cardapio.php");