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
              <label for="number" class="form-label ">Informe o primeiro número</label>
              <input type="number" id="number" name="number" class="form-control" step="any" required="">
            </div>
            <div class="mb-3">
                <label for="number2" class="form-label">Informe o segundo número</label>
                <input type="number" id="number2" name="number2" class="form-control" step="any" required="">
            </div>
<button type="submit" class="btn btn-primary">Multiplicar</button>
</form>

<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $number = $_POST["number"];
        $number2 = $_POST["number2"];
        $multiplicacao = $number * $number2;
        echo "
        <div class='container py-3 text-center font-bold'>
        <p>A Multiplicação dos números $number x $number2 = $multiplicacao</p>
        </div>
        ";}
    else {
        echo "<p>Por favor, preencha o formulário acima.</p>";
    }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


