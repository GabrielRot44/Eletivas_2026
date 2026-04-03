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
                            echo "  <div class='col-md'> <label for='palavra$i' class='form-label'>$i º Número:</label>
                                    <input type='text' step='any' id='palavra$i' name='palavras[]' class='form-control' required>
                                    </div>";
                        }
                    ?>
                </div>
<div class="text-center">
    <button type="submit" class="btn btn-primary mb-3">Calcular</button>
</div>
</form>
<!-- Crie um programa em PHP em que sejam lidas duas palavras e verifique se a segunda palavra
está contida na primeira -->
<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $palavras = $_POST["palavras"];
        $palavra1 = $palavras[0];
        $palavra2 = $palavras[1];
        echo("<div class='row inline-row mb-3 container py-3 text-center font-bold'>");
        if (strpos($palavra1, $palavra2) !== false) {
            echo("<p>'$palavra2' está contida em '$palavra1'</p>");
        } 
        else {
            echo("<p>'$palavra2' não está contida em '$palavra1'</p>");
        }
        echo("</div>");
    }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


