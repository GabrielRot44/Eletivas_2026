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
                        for ($i = 1; $i <= 5; $i++) {
                            echo " <div class='col-5 m-2'>
                                    <input type='text' id='nome$i' name='nome[]' placeholder='Nome' class='form-control' required>
                                    </div>";
                            echo " <div class='col-5 m-2'>
                                    <input type='text' id='telefone$i' name='telefone[]' placeholder='Telefone' class='form-control' required>
                                    </div>";
                        }
                    ?>
                </div>
<div class="text-center">
    <button type="submit" class="btn btn-primary mb-3">Calcular</button>
</div>
</form>
<!-- Crie um formulário que leia dados de 5 contatos: nome e número de
telefone.

Leia os dados e crie um mapa ordenado onde as chaves são os
nomes dos contatos e os valores são os números de telefone. 

Verifique se há duplicatas de nome ou número de telefone antes de adicionar um novo
contato. Exiba a lista ordenada pelos nomes dos contatos -->
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomes = $_POST["nome"];
    $telefones = $_POST["telefone"];
    $contatos = [];
    $duplicado = "";
    if (count($nomes) != count(array_unique($nomes))) {
        $duplicado = "Não pode haver nomes duplicados.";
    } elseif (count($telefones) != count(array_unique($telefones))) {
        $duplicado = "Não pode haver telefones duplicados.";
    } else {
        for ($i = 0; $i < 5; $i++) {
            $contatos[$nomes[$i]] = $telefones[$i];
        }
        ksort($contatos);
    }
    if ($duplicado != "") {
        echo "<div class='alert alert-danger mt-3 text-center'>$duplicado</div>";
    }
    if (!empty($contatos)) {
        echo "<h3 class='mt-4 text-center'>Contatos</h3>";
        echo "<ul class='list-group mt-3'>";

        foreach ($contatos as $nome => $telefone) {
            echo "<li class='list-group-item text-center'><strong>$nome</strong> - $telefone</li>";
        }

        echo "</ul>";
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</div>
</body>
</html>


