<?php
session_start();

if (!isset($_SESSION["logado"])) {
    header("Location: login.php");
    exit;
}
include("../includes/conexao.php");

$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4 text-center">Clientes Cadastrados</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Ação</th>
            </tr>
        </thead>

        <tbody>

        <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row["id"] ?></td>
                <td><?= $row["nome"] ?></td>
                <td><?= $row["cpf"] ?></td>
                <td><?= $row["telefone"] ?></td>
                <td><?= $row["email"] ?></td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
    <a href="dashboard.php" class="btn btn-danger mb-3">Voltar</a>
    <a href="exportar_clientes.php" class="btn btn-success mb-3">
    📥 Exportar para Excel
</a>
</div>

</body>
</html>