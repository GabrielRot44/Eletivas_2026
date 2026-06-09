<?php
session_start();
include("../includes/conexao.php");

if (!isset($_SESSION["logado"])) {
    header("Location: login.php");
    exit;
}

// 🔎 filtros
$data_inicio = $_GET['data_inicio'] ?? '';
$data_fim = $_GET['data_fim'] ?? '';
$cliente = $_GET['cliente'] ?? '';

// ✅ QUERY PRINCIPAL (SÓ CONCLUÍDOS)
$sql = "
    SELECT p.id, c.nome, p.total, p.data_pedido
    FROM pedidos p
    LEFT JOIN clientes c ON p.cliente_id = c.id
    WHERE p.status = 'concluido'
";

// filtros dinâmicos
if (!empty($data_inicio)) {
    $sql .= " AND DATE(p.data_pedido) >= '$data_inicio'";
}
if (!empty($data_fim)) {
    $sql .= " AND DATE(p.data_pedido) <= '$data_fim'";
}
if (!empty($cliente)) {
    $sql .= " AND c.nome LIKE '%$cliente%'";
}

$sql .= " ORDER BY p.data_pedido DESC";

$result = $conn->query($sql);

// 📊 RESUMOS (SÓ CONCLUÍDOS)
$total_geral = $conn->query("
    SELECT SUM(total) as total 
    FROM pedidos 
    WHERE status = 'concluido'
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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Faturamento</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.linha-pedido {
    transition: 0.2s;
}
.linha-pedido:hover {
    background-color: #e9ecef;
}
</style>
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4 text-center">📊 Relatório de Faturamento</h2>

    <!-- 📊 RESUMO -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="alert alert-success text-center">
                Hoje<br><strong>R$ <?= number_format($total_hoje ?? 0, 2, ',', '.') ?></strong>
            </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-primary text-center">
                Mês<br><strong>R$ <?= number_format($total_mes ?? 0, 2, ',', '.') ?></strong>
            </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-dark text-center">
                Total<br><strong>R$ <?= number_format($total_geral ?? 0, 2, ',', '.') ?></strong>
            </div>
        </div>
    </div>

    <!-- 🔎 FILTROS -->
    <form method="GET" class="row g-3 mb-4">

        <div class="col-md-3">
            <input type="date" name="data_inicio" class="form-control" value="<?= $data_inicio ?>">
        </div>

        <div class="col-md-3">
            <input type="date" name="data_fim" class="form-control" value="<?= $data_fim ?>">
        </div>

        <div class="col-md-3">
            <input type="text" name="cliente" class="form-control" placeholder="Buscar cliente" value="<?= $cliente ?>">
        </div>

        <div class="col-md-3 d-grid">
            <button class="btn btn-primary">🔍 Filtrar</button>
        </div>

    </form>

    <!-- BOTÕES -->
    <div class="mb-3">
        <a href="dashboard.php" class="btn btn-secondary">⬅ Voltar</a>
        <a href="exportar_faturamento.php" class="btn btn-success">📥 Excel</a>
    </div>

    <!-- 📋 TABELA -->
    <table class="table table-bordered table-striped">

        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Data</th>
                <th>Valor</th>
            </tr>
        </thead>

        <tbody>

        <?php while($row = $result->fetch_assoc()) { ?>

            <tr class="linha-pedido" data-bs-toggle="collapse" data-bs-target="#itens<?= $row['id'] ?>" style="cursor:pointer;">
                <td><?= $row["id"] ?></td>
                <td><?= $row["nome"] ?? "Sem cliente" ?></td>
                <td><?= date("d/m/Y H:i", strtotime($row["data_pedido"])) ?></td>
                <td>R$ <?= number_format($row["total"], 2, ',', '.') ?></td>
            </tr>

            <tr>
                <td colspan="4" class="p-0">
                    <div id="itens<?= $row['id'] ?>" class="collapse">

                        <table class="table table-sm mb-0 table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Produto</th>
                                    <th>Qtd</th>
                                    <th>Preço</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>

                            <?php
                            $itens = $conn->query("
                                SELECT * FROM itens_pedido 
                                WHERE pedido_id = {$row['id']}
                            ");

                            while($item = $itens->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= $item["produto"] ?></td>
                                    <td><?= $item["quantidade"] ?></td>
                                    <td>R$ <?= number_format($item["preco"], 2, ',', '.') ?></td>
                                    <td>R$ <?= number_format($item["subtotal"], 2, ',', '.') ?></td>
                                </tr>
                            <?php } ?>

                            </tbody>

                        </table>

                    </div>
                </td>
            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>