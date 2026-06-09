<?php
include("../includes/conexao.php");

$id = $_GET['id'];

$conn->query("DELETE FROM produtos WHERE id=$id");

header("Location: cardapio.php");