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
    <div class='col-md'> <label for='numero' class='form-label'>Número:</label>
    <input type='number' id='numero' name='numero' class='form-control' required step= 'any'>
    </div>
    </div>
<div class="text-center">
    <button type="submit" class="btn btn-primary mb-3">Calcular</button>
</div>
</form>
<!-- Crie um programa em PHP que receba um número de ponto flutuante e apresente:
• o número arredondado para cima
• o número arredondado para baixo
• o número arredondado normalmente-->
<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero = $_POST["numero"];
        $arredondado_cima = ceil($numero);
        $arredondado_baixo = floor($numero);
        $arredondado_normal = round($numero);
        echo("<div class='row inline-row mb-3 container py-3 text-center font-bold'>");
        echo("<p>O número $numero arredondado para cima é: $arredondado_cima</p>");
        echo("<p>O número $numero arredondado para baixo é: $arredondado_baixo</p>");
        echo("<p>O número $numero arredondado normalmente é: $arredondado_normal</p>");
        echo("</div>");
    }
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


