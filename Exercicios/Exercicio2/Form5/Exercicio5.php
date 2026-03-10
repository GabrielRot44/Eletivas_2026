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
              <label for="nota" class="form-label ">Nota 3 :</label>
              <input type="number" id="nota" name="nota" class="form-control" required="">
            </div>
            <div class="mb-3">
                <label for="nota2" class="form-label">Nota 2 :</label>
                <input type="number" id="nota2" name="nota2" class="form-control" required="">
            </div>
            <div class="mb-3">
                <label for="nota3" class="form-label">Nota 3 :</label>
                <input type="number" id="nota3" name="nota3" class="form-control" required="">
            </div>

<button type="submit" class="btn btn-primary">Fazer média</button>
</form>

<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nota = $_POST["nota"];
        $nota2 = $_POST["nota2"];
        $nota3 = $_POST["nota3"];

        $media = ($nota + $nota2 + $nota3) / 3; 

        echo ("
        <div class='container py-3 text-center font-bold'>
        <p>Média entre ($nota, $nota2, $nota3) = $media</p>
        </div>
        ");
    }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


