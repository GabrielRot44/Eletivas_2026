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
    
<div class="text-center">
    <button type="submit" class="btn btn-primary mb-3">Gerar senha</button>
</div>
</form>
<!-- Crie um programa em PHP que gere uma senha aleatória com 8 caracteres, contendo letras e
números.-->
<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $senha = '';
        for ($i = 0; $i < 8; $i++) {
            $senha .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
        echo("<div class='row inline-row mb-3 container py-3 text-center font-bold'>");
        echo("<p>Sua senha gerada é: $senha</p>");
        echo("</div>");
    }
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


