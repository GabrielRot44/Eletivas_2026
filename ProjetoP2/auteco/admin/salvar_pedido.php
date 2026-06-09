<?php
include("conexao.php");

// Cliente
$nome_cliente = $_POST["cliente_nome"] ?? '';

$stmt = $conn->prepare("SELECT id FROM clientes WHERE nome = ?");
$stmt->bind_param("s", $nome_cliente);
$stmt->execute();

$result = $stmt->get_result();
$cliente = $result->fetch_assoc();

$cliente_id = $cliente["id"] ?? null;

if (!$cliente_id) {
    die("Cliente não encontrado.");
}

// Dados do pedido
$produtos = $_POST["produto_id"] ?? [];
$quantidades = $_POST["quantidade"] ?? [];

if (count($produtos) == 0) {
    die("Adicione pelo menos um item.");
}


// Buscar produtos de uma vez
$ids = implode(",", $produtos);

$sql = "SELECT id, nome, preco FROM produtos WHERE id IN ($ids)";
$result = $conn->query($sql);

$mapa = [];
while ($p = $result->fetch_assoc()) {
    $mapa[$p['id']] = $p;
}

// Calcular total
$total = 0;

for ($i = 0; $i < count($produtos); $i++) {
    $produto = $mapa[$produtos[$i]];
    $subtotal = $quantidades[$i] * $produto["preco"];
    $total += $subtotal;
}

// Inserir pedido
$stmt = $conn->prepare("INSERT INTO pedidos (cliente_id, total, status) VALUES (?, ?, 'em_espera')");
$stmt->bind_param("id", $cliente_id, $total);
$stmt->execute();

$pedido_id = $stmt->insert_id;

// Inserir itens
for ($i = 0; $i < count($produtos); $i++) {

    $produto = $mapa[$produtos[$i]];
    $nome = $produto["nome"];
    $preco = $produto["preco"];
    $quantidade = $quantidades[$i];

    $subtotal = $quantidade * $preco;

    $stmt = $conn->prepare("
        INSERT INTO itens_pedido (pedido_id, produto, quantidade, preco, subtotal)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("isidd", $pedido_id, $nome, $quantidade, $preco, $subtotal);
    $stmt->execute();
}

header("Location: dashboard.php");
exit;
?>