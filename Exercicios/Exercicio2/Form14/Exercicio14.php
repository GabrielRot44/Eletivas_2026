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
              <label for="kilometros" class="form-label ">Valor em kilometros:</label>
              <input type="number" step="any" id="kilometros" name="kilometros" class="form-control" required="">
            </div>

<button type="submit" class="btn btn-primary">Converter</button>
</form>

<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $kilometros = $_POST["kilometros"];
        $kft = number_format($kilometros, 2,",",".");
        $milhas = $kilometros * 0.621371;
        $mft = number_format($milhas, 2,",",".");
        echo("
        <div class='container py-3 text-center font-bold'>
        <p>$kft kilometros são $mft milhas.</p>
        </div>
        ");
    }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


