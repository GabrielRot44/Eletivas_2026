<?php
session_start();
include("conexao.php");

if (!isset($_SESSION["logado"])) {
    header("Location: login.php");
    exit;
}


$data_inicio = $_GET['data_inicio'] ?? '';
$data_fim = $_GET['data_fim'] ?? '';


$filtro = "WHERE status = 'concluido'";

if (!empty($data_inicio)) {
    $filtro .= " AND DATE(data_pedido) >= '$data_inicio'";
}
if (!empty($data_fim)) {
    $filtro .= " AND DATE(data_pedido) <= '$data_fim'";
}

// RESUMOS
$total = $conn->query("
    SELECT SUM(total) as total 
    FROM pedidos 
    $filtro
")->fetch_assoc()['total'];

$total_hoje = $conn->query("
    SELECT SUM(total) as total 
    FROM pedidos 
    WHERE DATE(data_pedido) = CURDATE()
    AND status = 'concluido'
")->fetch_assoc()['total'];

$total_mes = $conn->query("
    SELECT SUM(total) as total 
    FROM pedidos 
    WHERE MONTH(data_pedido) = MONTH(CURDATE())
    AND YEAR(data_pedido) = YEAR(CURDATE())
    AND status = 'concluido'
")->fetch_assoc()['total'];

// STATUS
$concluidos = $conn->query("
    SELECT COUNT(*) as total 
    FROM pedidos 
    WHERE status='concluido'
")->fetch_assoc()['total'];

$espera = $conn->query("
    SELECT COUNT(*) as total 
    FROM pedidos 
    WHERE status='em_espera'
")->fetch_assoc()['total'];

$cancelados = $conn->query("
    SELECT COUNT(*) as total 
    FROM pedidos 
    WHERE status='cancelado'
")->fetch_assoc()['total'];

// RanKING CORRIGIDO (SÓ PEDIDOS CONCLUÍDOS)
$ranking = $conn->query("
    SELECT i.produto, 
           SUM(i.quantidade) as total_qtd,
           SUM(i.subtotal) as total_valor
    FROM itens_pedido i
    INNER JOIN pedidos p ON i.pedido_id = p.id
    WHERE p.status = 'concluido'
    GROUP BY i.produto
    ORDER BY total_qtd DESC
    LIMIT 5
");
// CLIENTES QUE MAIS PEDIRAM
$ranking_clientes = $conn->query("
    SELECT c.nome, 
           COUNT(p.id) as total_pedidos,
           SUM(p.total) as total_gasto
    FROM pedidos p
    INNER JOIN clientes c ON p.cliente_id = c.id
    WHERE p.status = 'concluido'
    GROUP BY c.nome
    ORDER BY total_pedidos DESC
    LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Relatório Completo</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background-color: #f4f6f9;
}

.card {
    border-radius: 10px;
}

.card:hover {
    transform: scale(1.02);
    transition: 0.2s;
}
</style>
</head>
<body>

<div class="container mt-5">

<h2 class="mb-4 text-center">📊 Relatório Completo</h2>

<!-- FILTRO -->
<form method="GET" class="row g-3 mb-4">
    <div class="col-md-4">
        <input type="date" name="data_inicio" class="form-control" value="<?= $data_inicio ?>">
    </div>
    <div class="col-md-4">
        <input type="date" name="data_fim" class="form-control" value="<?= $data_fim ?>">
    </div>
    <div class="col-md-4 d-grid">
        <button class="btn btn-primary">Filtrar</button>
    </div>
</form>

<!--RESUMOS -->
<div class="row mb-4">

    <div class="col-md-4">
        <div class="alert alert-success text-center">
            Total<br>
            <strong>R$ <?= number_format($total ?? 0, 2, ',', '.') ?></strong>
        </div>
    </div>

    <div class="col-md-4">
        <div class="alert alert-primary text-center">
            Hoje<br>
            <strong>R$ <?= number_format($total_hoje ?? 0, 2, ',', '.') ?></strong>
        </div>
    </div>

    <div class="col-md-4">
        <div class="alert alert-dark text-center">
            Mês<br>
            <strong>R$ <?= number_format($total_mes ?? 0, 2, ',', '.') ?></strong>
        </div>
    </div>

</div>

<!--STATUS -->
<div class="row mb-4">

    <div class="col-md-4">
        <div class="card p-3 text-center">
            ✔ Concluídos<br>
            <strong><?= $concluidos ?></strong>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 text-center">
            ⏳ Em Espera<br>
            <strong><?= $espera ?></strong>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 text-center">
            ❌ Cancelados<br>
            <strong><?= $cancelados ?></strong>
        </div>
    </div>

</div>

<!--RANKING -->
<div class="card p-4">
    <h5>🥇 Produtos Mais Vendidos</h5>

    <table class="table mt-3 table-striped">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Faturamento</th>
            </tr>
        </thead>
        <tbody>
            <?php while($r = $ranking->fetch_assoc()) { ?>
                <tr>
                    <td><?= $r['produto'] ?></td>
                    <td><?= $r['total_qtd'] ?></td>
                    <td>R$ <?= number_format($r['total_valor'], 2, ',', '.') ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="card p-4 mt-4">
    <h5>🏆 Clientes que mais pediram</h5>

    <table class="table mt-3 table-striped">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Pedidos</th>
                <th>Total Gasto</th>
            </tr>
        </thead>
        <tbody>

        <?php while($c = $ranking_clientes->fetch_assoc()) { ?>
            <tr>
                <td><?= $c['nome'] ?></td>
                <td><?= $c['total_pedidos'] ?></td>
                <td>R$ <?= number_format($c['total_gasto'], 2, ',', '.') ?></td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
</div>
<!--VOLTAR -->
<a href="dashboard.php" class="btn btn-danger mt-4">⬅ Voltar</a>

</div>

</body>
</html>