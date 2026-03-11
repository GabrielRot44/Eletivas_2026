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
              <label for="capital" class="form-label ">capital inicial:</label>
              <input type="number" step="any" id="capital" name="capital" class="form-control" required="">
            </div>
            <div class="mb-3">
              <label for="juros" class="form-label ">juros(%):</label>
              <input type="number" step="any" id="juros" name="juros" class="form-control" required="">
            </div>
              <div class="mb-3">
              <label for="periodo" class="form-label ">periodo(mês):</label>
              <input type="number" id="periodo" name="periodo" class="form-control" required="">
            </div>

<button type="submit" class="btn btn-primary">Calcular</button>
</form>

<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $capital = $_POST["capital"];
        $juros = $_POST["juros"];
        $periodo = $_POST["periodo"];
        $capital_total = ($capital * $juros * $periodo);
        $capital_f = number_format($capital, 2,",",".");
        $capital_final = number_format($capital_total,2 , ",",".");
        echo("
        <div class='container py-3 text-center font-bold'>
        <p>Capital inicial: R$ $capital_f </p>
        <p>Taxa de Juros: $juros% </p>
        <p>Periodo: $periodo meses </p>
        <p>Capital Final: R$ $capital_final</p>
        </div>
        ");
    }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


