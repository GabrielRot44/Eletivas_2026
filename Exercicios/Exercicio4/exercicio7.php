<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercicio 3</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
<style>
    .font-bold{
        font-weight: bold;
    }
</style>
</head>

<body> 
<div class="container py-3">

<form method="post" action="">
    <div class="row inline-row mb-3">                
    <div class='col-md'> <label for='palavra' class='form-label'>Palavra:</label>
    <input type='text' id='palavra' name='palavra' class='form-control' required>
    </div>
    </div>
<div class="text-center">
    <button type="submit" class="btn btn-primary mb-3">Calcular</button>
</div>
</form>
<!-- Crie um programa em PHP que leia uma palavra e apresente essa palavra invertida.
Exemplo:
Entrada → programacao
Saída → oacamargorp -->
<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $palavra = $_POST["palavra"];
        $palavra_invertida = strrev($palavra);

        echo("<div class='row inline-row mb-3 container py-3 text-center font-bold'>");
        echo("<p>A palavra '$palavra' invertida é: '$palavra_invertida'</p>");
        echo("</div>");
    }
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


