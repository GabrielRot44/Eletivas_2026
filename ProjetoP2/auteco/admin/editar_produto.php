<?php
include("../includes/conexao.php");

$id = $_GET['id'];

$p = $conn->query("SELECT * FROM produtos WHERE id=$id")->fetch_assoc();
?>

<form method="POST" action="atualizar_produto.php">

<input type="hidden" name="id" value="<?= $p['id'] ?>">

<input type="text" name="nome" value="<?= $p['nome'] ?>" class="form-control mb-2">

<textarea name="descricao" class="form-control mb-2"><?= $p['descricao'] ?></textarea>

<input type="number" step="0.01" name="preco" value="<?= $p['preco'] ?>" class="form-control mb-2">

<input type="text" name="categoria" value="<?= $p['categoria'] ?>" class="form-control mb-2">

<button class="btn btn-primary">Atualizar</button>

</form>