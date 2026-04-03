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
    <div class='col-md'> <label for='frase' class='form-label'>Nome Completo:</label>
    <input type='text' id='frase' name='frase' class='form-control' required>
    </div>
    </div>
<div class="text-center">
    <button type="submit" class="btn btn-primary mb-3">Calcular</button>
</div>
</form>
<!-- Crie um programa em PHP que leia um nome completo e apresente apenas as iniciais.
Exemplo:
Entrada → Maria Silva Souza
Saída → M.S.S -->
<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $frase = $_POST["frase"];
        $palavras = explode(" ", $frase);
        $iniciais = "";
        
        foreach ($palavras as $palavra) {
            $iniciais .= strtoupper($palavra[0]) . ".";
        }
        $iniciais = rtrim($iniciais, ".");
        
        echo("<div class='row inline-row mb-3 container py-3 text-center font-bold'>");
        echo("<p>As iniciais do nome '$frase' são: '$iniciais'</p>");
        echo("</div>");
    }
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


