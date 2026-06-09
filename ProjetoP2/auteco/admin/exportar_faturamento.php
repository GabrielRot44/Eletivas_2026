<?php
include("../includes/conexao.php");

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=faturamento.xls");

echo "\xEF\xBB\xBF";
echo "ID\tCliente\tData\tValor (R$)\n";

$sql = "
    SELECT p.id, c.nome, p.total, p.data_pedido
    FROM pedidos p
    LEFT JOIN clientes c ON p.cliente_id = c.id
    ORDER BY p.data_pedido DESC
";

$result = $conn->query($sql);

// 
while($row = $result->fetch_assoc()) {

    $data = date("d/m/Y", strtotime($row['data_pedido']));
    $valor = number_format($row['total'], 2, ',', '.');

    echo $row['id'] . "\t" .
         $row['nome'] . "\t" .
         $data . "\t" .
         $valor . "\n";
}
?>