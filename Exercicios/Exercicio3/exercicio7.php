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
    <div class='col-md'> <label for='numero' class='form-label'>Número</label>
    <input type='number' step='any' id='numero' name='numero' class='form-control' required>
    </div>
    </div>
<div class="text-center">
    <button type="submit" class="btn btn-primary mb-3">Calcular</button>
</div>
</form>
<!-- Crie um formulário para que o usuário informe um número. Use um loop
while para somar todos os números de 1 até o número informado e exibir o
resultado. --->
<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero = $_POST["numero"];
        $soma = 0;
        $i = 1;

        while ($i <= $numero) {
            $soma += $i;
            $i++;
        }

        echo("<div class='container py-3 text-center font-bold'>");
        echo("<p>A soma de todos os números anteriores a $numero é: $soma</p>");
        echo("</div>");
    }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


