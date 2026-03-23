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
    <div class='col-md'> <label for='mes' class='form-label'>Mês:</label>
    <input type='number' step='any' id='mes' name='mes' class='form-control' required>
    </div>
    </div>
<div class="text-center">
    <button type="submit" class="btn btn-primary mb-3">Calcular</button>
</div>
</form>
<!--Faça um programa que leia o valor associado a um mês. Exemplo: 1 –
Janeiro, 2 – Fevereiro... Exiba o nome do mês associado = USE SWITCH -->
<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mes = $_POST["mes"];

        switch ($mes) {
            case 1:
                $nomeMes = "Janeiro";
                break;
            case 2:
                $nomeMes = "Fevereiro";
                break;
            case 3:
                $nomeMes = "Março";
                break;
            case 4:
                $nomeMes = "Abril";
                break;
            case 5:
                $nomeMes = "Maio";
                break;
            case 6:
                $nomeMes = "Junho";
                break;
            case 7:
                $nomeMes = "Julho";
                break;
            case 8:
                $nomeMes = "Agosto";
                break;
            case 9:
                $nomeMes = "Setembro";
                break;
            case 10:
                $nomeMes = "Outubro";
                break;
            case 11:
                $nomeMes = "Novembro";
                break;
            case 12:
                $nomeMes = "Dezembro";
                break;
            default:
                $nomeMes = "Mês inválido";
        }

        echo("
        <div class='container py-3 text-center font-bold'>
        <p>O mês é: $nomeMes</p>
        </div>
        ");
    }

?>
 
</div>
</body>
</html>


