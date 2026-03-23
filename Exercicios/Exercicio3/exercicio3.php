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
                    <?php
                        for ($i = 1; $i <= 2; $i++) {
                            echo "  <div class='col-md'> <label for='numero$i' class='form-label'>$i º Número:</label>
                                    <input type='number' step='any' id='numero$i' name='numeros[]' class='form-control' required>
                                    </div>";
                        }
                    ?>
                </div>
<div class="text-center">
    <button type="submit" class="btn btn-primary mb-3">Calcular</button>
</div>
</form>

<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numeros = $_POST["numeros"];

        if ($numeros[0] == $numeros[1]) {
            $numero = $numeros[0];
            echo("
            <div class='container py-3 text-center font-bold'>
            <p>Números iguais:$numero.</p>
            </div>");
            return;         
        }
        $menor = $numeros[0];
        $maior = $numeros[1];
        for ($i = 0 ; $i < 2; $i++) {
            if ($numeros[$i] < $menor) {
                $menor = $numeros[$i];
                $maior = $numeros[1 - $i];
            }
        }

        echo("
        <div class='container py-3 text-center font-bold'>
        <p>$menor $maior</p>
        </div>
        ");
    }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


