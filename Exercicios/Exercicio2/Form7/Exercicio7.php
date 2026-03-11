<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercicio 2</title>
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
            <div class="mb-3">
              <label for="temp" class="form-label ">Temperatura em ºF</label>
              <input type="number" id="temp" name="temp" class="form-control" step="any" required="">
            </div>

<button type="submit" class="btn btn-primary">Fazer conversão</button>
</form>

<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tempF = $_POST["temp"];
        $tempC = (($tempF - 32)*5 )/9;
        echo ("
        <div class='container py-3 text-center font-bold'>
        <p>$tempC ºC é igual a $tempF ºF</p>
        </div>
        ");
    }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


