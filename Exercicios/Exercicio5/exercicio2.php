<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercicio 5</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
<style>
    .font-bold{
        font-weight: bold;
    }
</style>
</head>

<body> 
<div class="container py-3">

<form method="POST">
                <div class="row inline-row m-3 justify-content-center">
                    <?php
                        for ($i = 0; $i < 5; $i++) {
                            echo " <div class='col-5 m-2'>
                                    <input type='text' id='nome$i' name='nome[]' placeholder='Nome' class='form-control' required>
                                    </div>";
                            for ($a = 0; $a < 3; $a++) {
                            echo " <div class='col m-2'>
                                    <input type='number' id='nota$a' name='nota[$i][]' placeholder='Nota " .($a + 1)."' class='form-control' required>
                                    </div>";     
                            }
                        }
                    ?>
                </div>
<div class="text-center">
    <button type="submit" class="btn btn-primary mb-3">Calcular</button>
</div>
</form>
<!--Crie um formulário que leia dados de 5 alunos: nome e três notas.
Leia os dados e crie um mapa ordenado onde as chaves são os nomes dos alunos
e os valores são as médias das notas. 
Exiba a lista de alunos ordenada pela
média das notas (do maior para o menor) -->
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomes = $_POST['nome'];
    $notas = $_POST['nota'];
    $alunos = [];
    for ($i = 0; $i < count($nomes); $i++) {
        $media = array_sum($notas[$i]) / count($notas[$i]);
        $alunos[$nomes[$i]] = $media;
    }   
    arsort($alunos);
    echo "<ul class='list-group'>";
    foreach ($alunos as $nome => $media) {
        echo "<li class='list-group-item'>$nome: " . number_format($media, 1) . "</li>";
    }
    echo "</ul>";
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


