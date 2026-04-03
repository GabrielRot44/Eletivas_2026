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
    <div class='col-md'> <label for='frase' class='form-label'>Frase:</label>
    <input type='text' id='frase' name='frase' class='form-control' required>
    </div>
    </div>
<div class="text-center">
    <button type="submit" class="btn btn-primary mb-3">Calcular</button>
</div>
</form>
<!-- Crie um programa em PHP que leia uma frase e apresente:
• a frase original
• a frase sem espaços extras no início e no final
• a frase com todos os espaços removidos -->
<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $frase = $_POST["frase"];
        $frase_sem_espacos = trim($frase);
        $frase_sem_todos_espacos = str_replace(' ', '', $frase);
        
        echo("<div class='row inline-row mb-3 container py-3 text-center font-bold'>");
        echo("<p>A frase sem espaços extras é: '$frase_sem_espacos'</p>");
        echo("<p>A frase sem todos os espaços é: '$frase_sem_todos_espacos'</p>");
        echo("</div>");
    }
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


