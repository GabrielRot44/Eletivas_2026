<?php 

    date_default_timezone_set("America/Sao_Paulo");
    $date = date("| d/m/y | H:i:s |");
    echo "<h3>$date</h3>";

    $valor = 1505.88888888888;
    $valor_arredondado = round($valor) ;
    echo "<p>Valor : $valor</p>";
    echo "<p>Valor arredondado : $valor_arredondado</p>";
    $valor_formatado = number_format($valor, 2, ",", ".");
    echo "<p>Valor formatado : $valor_formatado</p>";
    echo"<h3>Funções matematicas</h3>";
    //exponenciação
    $exp = pow(3,4);
    echo "<p>3^4 = $exp</p>";
    //Raiz quadrada
    $raiz = sqrt(16);
    echo "<p>Raiz de 16 = $raiz</p>";
    //Número Aleatório
    $aleatorio = rand(1, 100);
    echo "<p>Número aleatório entre 1 e 100 : $aleatorio</p>";

    echo "<h3>Funções em sistemas de decisão</h3>";

    if(isset($nome)){
        echo "<p>Nome informado!</p>";
    }
    else {
        echo "<p>Nome não informado!</p>";
        // die() == break
        die();
    }

    if(is_float($valor)){
        echo "<p>É um número flutuante!</p>";
    }
    else {
        echo "Não é um número flutuante!";
    }




?>