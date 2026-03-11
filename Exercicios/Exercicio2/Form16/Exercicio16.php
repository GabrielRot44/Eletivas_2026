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
              <label for="preco" class="form-label ">preco:</label>
              <input type="number" step="any" id="preco" name="preco" class="form-control" required="">
            </div>
            <div class="mb-3">
              <label for="desconto" class="form-label ">desconto(%):</label>
              <input type="number" step="any" id="desconto" name="desconto" class="form-control" required="">
            </div>

<button type="submit" class="btn btn-primary">Calcular</button>
</form>

<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $preco = $_POST["preco"];
        $desconto = $_POST["desconto"];
        $valor_descontado = $preco * ($desconto/100);
        $valor_final = $preco - $valor_descontado;
        $valor_final_f = number_format($valor_final, 2,",",".");
        $preco_f = number_format($preco, 2, ",",".");
        echo("
        <div class='container py-3 text-center font-bold'>
        <p>O produto de R$ $preco_f com $desconto% de desconto vale R$ $valor_final_f </p>
        </div>
        ");
    }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


