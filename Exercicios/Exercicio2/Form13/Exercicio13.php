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
              <label for="metros" class="form-label ">Valor em metros:</label>
              <input type="number" step="any" id="metros" name="metros" class="form-control" required="">
            </div>

<button type="submit" class="btn btn-primary">Converter</button>
</form>

<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $metros = $_POST["metros"];
        $mft = number_format($metros, 2,",",".");
        $centimetros = $metros * 100;
        $cft = number_format($centimetros, 2,",",".");
        echo("
        <div class='container py-3 text-center font-bold'>
        <p>$mft metros tem $cft centimetros.</p>
        </div>
        ");
    }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


