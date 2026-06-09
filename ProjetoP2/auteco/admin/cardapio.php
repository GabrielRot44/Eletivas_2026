<?php
session_start();
include("conexao.php");

if (!isset($_SESSION["logado"])) {
    header("Location: login.php");
    exit;
}

$produtos = $conn->query("SELECT * FROM produtos ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cardápio</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.card-produto {
    border-radius: 12px;
    transition: 0.2s;
}

.card-produto:hover {
    transform: scale(1.02);
}

.img-produto {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 10px;
}
</style>

</head>

<body>

<div class="container mt-5">

<h2 class="mb-4">Cardápio (Admin)</h2>

<a href="cadastrar_produto.php" class="btn btn-success mb-3">+ Novo Produto</a>
<a href="dashboard.php" class="btn btn-danger mb-3">Voltar</a>

<div class="row">

<?php while($p = $produtos->fetch_assoc()) { ?>

<div class="col-md-6 mb-4">

    <div class="card card-produto shadow-sm p-3">

        <div class="d-flex align-items-start">

            <!-- IMAGEM -->
            <img 
                src="../<?= !empty($p['imagem']) ? $p['imagem'] : 'uploads/padrao' ?>" 
                class="img-produto"
            >


            <!-- TEXTO -->
            <div class="ms-3 w-100">

                <h5 class="mb-1"><?= $p['nome'] ?></h5>

                <p class="text-muted mb-2" style="font-size: 14px;">
                    <?= $p['descricao'] ?>
                </p>

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <strong class="text-success">
                            R$ <?= number_format($p['preco'], 2, ',', '.') ?>
                        </strong>
                        <br>
                        <small class="text-muted"><?= $p['categoria'] ?></small>
        
                    </div>

                    <!-- AÇÕES -->
                    <div>
                        <a href="editar_produto.php?id=<?= $p['id'] ?>" 
                           class="btn btn-warning btn-sm">Editar</a>

                        <a href="excluir_produto.php?id=<?= $p['id'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Excluir produto?')">
                           Excluir
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php } ?>

</div>

</div>

</body>
</html>