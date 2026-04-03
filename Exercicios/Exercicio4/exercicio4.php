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
    <div class='col-md'> <label for='dia' class='form-label'>Dia:</label>
    <input type='number' id='dia' name='dia' class='form-control' required>
    </div>
    <div class='col-md'> <label for='mes' class='form-label'>Mês:</label>
    <input type='number' id='mes' name='mes' class='form-control' required>
    </div>
    <div class='col-md'> <label for='ano' class='form-label'>Ano:</label>
    <input type='number' id='ano' name='ano' class='form-control' required>
    </div>
    </div>
<div class="text-center">
    <button type="submit" class="btn btn-primary mb-3">Calcular</button>
</div>
</form>
<!-- Crie um programa em PHP que leia três valores: dia, mês e ano. Verifique se a data informada
é válida e apresente a data no formato dd/mm/YYYY. -->
<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dia = $_POST["dia"];
        $mes = $_POST["mes"];
        $ano = $_POST["ano"];
        if (checkdate($mes, $dia, $ano)) {
            echo("<div class='row inline-row mb-3 container py-3 text-center font-bold'>");
            echo("<p>Data válida: $dia/$mes/$ano</p>");
            echo("</div>");
        } 
        else {
            echo("<div class='row inline-row mb-3 container py-3 text-center font-bold'>");
            echo("<p>Data inválida.</p>");
            echo("</div>");
        }
    }
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


<!doctype html>