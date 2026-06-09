<?php
session_start();
include("../includes/conexao.php");

if (!isset($_SESSION["logado"])) {
    header("Location: login.php");
    exit;
}

// pedidos últimas 24h
$pedidos = $conn->query("
    SELECT p.id, c.nome, p.total, p.data_pedido, p.status
    FROM pedidos p
    LEFT JOIN clientes c ON p.cliente_id = c.id
    WHERE p.data_pedido >= NOW() - INTERVAL 1 DAY
    ORDER BY p.data_pedido DESC
");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Pedidos - Últimas 24h</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.linha-hover {
    transition: 0.2s;
}
.linha-hover:hover {
    background-color: #f1f3f5;
}
tr.cancelado {
    background-color: #f55a67;
}
</style>

</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4 text-center">🧾 Pedidos (Últimas 24h)</h2>

    <div class="mb-3">
        <a href="dashboard.php" class="btn btn-secondary">⬅ Voltar</a>
    </div>

    <table class="table table-bordered table-striped">

        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Data/Hora</th>
                <th>Valor</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
        </thead>

        <tbody>

        <?php while($p = $pedidos->fetch_assoc()) { ?>

            <tr class="linha-hover <?= $p['status'] == 'cancelado' ? 'cancelado' : '' ?>">
                <td><?= $p["id"] ?></td>
                <td><?= $p["nome"] ?? "Sem cliente" ?></td>
                <td><?= date("d/m/Y H:i", strtotime($p["data_pedido"])) ?></td>
                <td>R$ <?= number_format($p["total"], 2, ',', '.') ?></td>

                <td>
                    <?php if ($p["status"] == "em_espera") { ?>
                        <span class="badge bg-warning text-dark">Em espera</span>
                    <?php } elseif ($p["status"] == "concluido") { ?>
                        <span class="badge bg-success">Concluído</span>
                    <?php } else { ?>
                        <span class="badge bg-danger">Cancelado</span>
                    <?php } ?>
                </td>

                <td>
                    <?php if ($p["status"] == "em_espera") { ?>

                        <a href="concluir_pedido.php?id=<?= $p['id'] ?>" 
                        class="btn btn-success btn-sm">
                            ✔ Concluir
                        </a>

                        <a href="cancelar_pedido.php?id=<?= $p['id'] ?>" 
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Deseja cancelar este pedido?')">
                            ❌ Cancelar
                        </a>

                    <?php } ?>
                </td>
            </tr>

            <tr>
                <td colspan="6">
                    
                    <strong>Itens do pedido:</strong>

                    <table class="table table-sm table-bordered mt-2">
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
                            WHERE pedido_id = {$p['id']}
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

                </td>
            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</body>
</html>