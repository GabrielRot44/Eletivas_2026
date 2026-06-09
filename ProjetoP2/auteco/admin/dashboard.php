<?php
session_start();
include("../includes/conexao.php");

if (!isset($_SESSION["logado"])) {
    header("Location: login.php");
    exit;
}

$dados_grafico = $conn->query("
    SELECT DATE(data_pedido) as data, SUM(total) as total
    FROM pedidos
    WHERE status = 'concluido'
    AND data_pedido >= NOW() - INTERVAL 7 DAY
    GROUP BY DATE(data_pedido)
");

$labels = [];
$valores = [];

while ($d = $dados_grafico->fetch_assoc()) {
    $labels[] = date("d/m", strtotime($d['data']));
    $valores[] = $d['total'];
}

$total_clientes = $conn->query("
    SELECT COUNT(*) as total FROM clientes
")->fetch_assoc()['total'];


$faturamento = $conn->query("
    SELECT SUM(total) as total 
    FROM pedidos 
    WHERE status = 'concluido'
")->fetch_assoc()['total'];


$faturamento_hoje = $conn->query("
    SELECT SUM(total) as total 
    FROM pedidos 
    WHERE DATE(data_pedido) = CURDATE()
    AND status = 'concluido'
")->fetch_assoc()['total'];


$em_espera = $conn->query("
    SELECT COUNT(*) as total 
    FROM pedidos 
    WHERE status = 'em_espera'
")->fetch_assoc()['total'];


$cancelados = $conn->query("
    SELECT COUNT(*) as total 
    FROM pedidos 
    WHERE status = 'cancelado'
")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Dashboard - Aut-eco</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    overflow-x: hidden;
    background-color: #f4f6f9;
}

.sidebar {
    height: 100vh;
    width: 240px;
    position: fixed;
    background: linear-gradient(180deg, #1f2937, #111827);
    padding-top: 20px;
}

.sidebar h4 {
    color: white;
    text-align: center;
    margin-bottom: 30px;
}

.sidebar a {
    color: #cbd5e1;
    display: block;
    padding: 12px 20px;
    text-decoration: none;
    font-size: 15px;
}

.sidebar a:hover {
    background-color: #374151;
    color: white;
}

.content {
    margin-left: 240px;
    padding: 20px;
}

.navbar-custom {
    margin-left: 240px;
    background-color: white;
}

.card-dashboard {
    border-radius: 12px;
    transition: 0.3s;
}

.card-dashboard:hover {
    transform: scale(1.03);
}

.icon {
    font-size: 30px;
}
</style>

</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4>Aut-eco</h4>

    <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="cadastro_cliente.php"><i class="bi bi-person-plus"></i> Cadastrar Cliente</a>
    <a href="listar_clientes.php"><i class="bi bi-people"></i> Clientes</a>
    <a href="cardapio.php"><i class="bi bi-basket"></i> Cardápio</a>
    <a href="novo_pedido.php"><i class="bi bi-receipt"></i> Novo Pedido</a>
    <a href="pedidos_hoje.php"><i class="bi bi-clock-history"></i> Pedidos</a>
    <a href="relatorio.php"><i class="bi bi-bar-chart"></i> Relatório</a>
    <a href="logout.php" class="text-danger"><i class="bi bi-box-arrow-right"></i> Sair</a>
</div>

<!-- NAVBAR -->
<nav class="navbar navbar-light navbar-custom shadow-sm px-4">
    <span class="navbar-brand">
        👋 Olá, <strong><?= $_SESSION["usuario"] ?></strong>
    </span>
</nav>


<!-- CONTEÚDO -->
<div class="content">

    <h3 class="mb-4">Dashboard</h3>

    <div class="row g-4">

        <!-- CLIENTES -->
        <div class="col-md-4">
            <div class="card card-dashboard shadow p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Clientes</h6>
                        <h3><?= $total_clientes ?></h3>
                    </div>
                    <i class="bi bi-people icon text-primary"></i>
                </div>
                <a href="listar_clientes.php" class="btn btn-sm btn-primary mt-3">Ver Clientes</a>
            </div>
        </div>

        <!-- EM ESPERA -->
        <div class="col-md-4">
            <div class="card card-dashboard shadow p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Em Espera</h6>
                        <h3><?= $em_espera ?></h3>
                    </div>
                    <i class="bi bi-clock icon text-warning"></i>
                </div>
                <a href="pedidos_hoje.php" class="btn btn-warning btn-sm mt-3">
                    Ver Pedidos
                </a>
            </div>
        </div>
        <!-- FATURAMENTO HOJE -->
        <div class="col-md-4">
            <div class="card card-dashboard shadow p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Faturamento Hoje</h6>
                        <h3>R$ <?= number_format($faturamento_hoje ?? 0, 2, ',', '.') ?></h3>
                    </div>
                    <i class="bi bi-cash icon text-success"></i>
                </div>
                <a href="listar_faturamento.php" class="btn btn-success btn-sm mt-3">
                    Ver Relatório
                </a>
            </div>
        </div>
    <div class="card shadow mt-4 p-4">
        <h5 class="mb-3">📊 Faturamento (Últimos 7 dias)</h5>
        <canvas id="graficoFaturamento"></canvas>
    </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('graficoFaturamento');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
            label: 'Faturamento (R$)',
            data: <?= json_encode($valores) ?>,
            tension: 0.3,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true
            }
        }
    }
});
</script>
</body>
</html>