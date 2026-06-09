
<?php
session_start();
include("conexao.php");

if (!isset($_SESSION["logado"])) {
    header("Location: login.php");
    exit;
}

include("conexao.php");


header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=clientes.xls");


$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);


echo "ID\tNome\tCPF\tTelefone\tEmail\n";

while($row = $result->fetch_assoc()) {
    echo $row['id'] . "\t" .
         $row['nome'] . "\t" .
         $row['cpf'] . "\t" .
         $row['telefone'] . "\t" .
         $row['email'] . "\n";
}
?>