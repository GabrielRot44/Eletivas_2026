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
              <label for="raio" class="form-label ">Raio do círculo</label>
              <input type="number" id="raio" name="raio" class="form-control" required="">
            </div>

<button type="submit" class="btn btn-primary">Calcular de área</button>
</form>

<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $raio = $_POST["raio"];
        $pi = pi();
        $area = 2 * $pi * $raio;
        echo("
        <div class='container py-3 text-center font-bold'>
        <p>pi = ($pi)</p>
        <p>O círculo de raio($raio) tem área = $area</p>
        </div>
        ");
    }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


