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
                            echo " <div class='col-3 m-2'>
                                    <input type='number' id='preco$i' name='preco[]' placeholder='Preço' class='form-control' required>
                                    </div>";
                        }
                    ?>
                </div>
<div class="text-center">
    <button type="submit" class="btn btn-primary mb-3">Calcular</button>
</div>
</form>
<!-- 
Crie um formulário que leia dados de 5 itens: nome e preço. 
Leia os dados e crie um mapa ordenado onde as chaves são os nomes dos itens e os
valores são os preços após aplicação de um imposto de 15%. 
Exiba a lista ordenada pelos preços após a aplicação do imposto.
-->
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomes = $_POST['nome'];
    $precos = $_POST['preco'];
    $produtos = [];
    for ($i = 0; $i < count($nomes); $i++) {
        $preco = $precos[$i];
        $preco *= 1.15;
        $produtos[$nomes[$i]] = $preco;
    }
    uasort($produtos, function($a, $b) {
        return $a - $b;
    });
    echo "<ul class='list-group'>";
    foreach ($produtos as $nome => $preco) {
        echo "<li class='list-group-item'>$nome: R$ " . number_format($preco, 2, ',', '.') . "</li>";
    }
    echo "</ul>";
}   
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


