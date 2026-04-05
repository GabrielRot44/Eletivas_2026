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
                                    <input type='text' id='nome$i' name='nome[]' placeholder='Titulo' class='form-control' required>
                                    </div>";
                            echo " <div class='col-3 m-2'>
                                    <input type='number' id='estoque$i' name='estoque[]' placeholder='Estoque' class='form-control' required>
                                    </div>";
                        }
                    ?>
                </div>
<div class="text-center">
    <button type="submit" class="btn btn-primary mb-3">Calcular</button>
</div>
</form>
<!-- 
Crie um formulário que leia dados de 5 livros: título e quantidade em
estoque. 

Leia os dados e crie um mapa ordenado onde as chaves são os
títulos dos livros e os valores são a quantidade em estoque. 

Verifique se a quantidade em estoque é inferior a 5 e exiba um alerta para os livros com
baixa quantidade. Exiba a lista ordenada pelo título dos livros.
-->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomes = $_POST['nome'];
    $estoque = $_POST['estoque'];
    $produtos = [];
    $alertas = "";
    for ($i = 0; $i < 5; $i++) {
        $produtos[$nomes[$i]] = $estoque[$i];
        if ($estoque[$i] < 5) {
            $alertas .= "<div class='alert alert-warning text-center'>
                            O livro <strong>{$nomes[$i]}</strong> tem baixa quantidade: {$estoque[$i]} unidades.
                         </div>";
        }
    }
    ksort($produtos);
    echo $alertas;
    echo "<ul class='list-group mt-3'>";
    foreach ($produtos as $nome => $quantidade) {
        echo "<li class='list-group-item justify-content-center d-flex boxder-0'>
                <strong>$nome</strong>: $quantidade unidades
              </li>";
    }
    echo "</ul>"; 
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


