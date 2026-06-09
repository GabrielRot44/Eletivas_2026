<?php
include("conexao.php");
$clientes = $conn->query("SELECT * FROM clientes");
$produtos = $conn->query("SELECT * FROM produtos");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Novo Pedido</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script id="fix1">
    const produtosOptions = `
        <?php
            $produtos->data_seek(0);
            while($p = $produtos->fetch_assoc()) {
                echo "<option value='{$p['id']}' data-preco='{$p['preco']}'>{$p['nome']}</option>";
            }
        ?>
    `;
</script>
<script id="fix2">
function adicionarItem() {

    let tabela = document.getElementById("itens");

    let linha = document.createElement("tr");

    linha.innerHTML = `
        <td>
            <select name="produto_id[]" class="form-control" onchange="preencherPreco(this)" required>
                <option value="">Selecione</option>
                ${produtosOptions}
            </select>
        </td>

        <td>
            <input type="number" name="quantidade[]" class="form-control" min="1" required>
        </td>

        <td>
            <input type="number" step="0.01" name="preco[]" class="form-control" readonly>
        </td>

        <td>
            <button type="button" class="btn btn-danger btn-sm" onclick="removerItem(this)">❌</button>
        </td>
    `;

    tabela.appendChild(linha);
}

function preencherPreco(select) {
    let preco = select.options[select.selectedIndex].getAttribute("data-preco");
    let linha = select.closest("tr");

    linha.querySelector("input[name='preco[]']").value = preco;
}

function removerItem(botao) {
    botao.closest("tr").remove();
}
</script>



</head>
<body>

<div class="container mt-5">

<h3>Novo Pedido</h3>

<form method="POST" action="salvar_pedido.php">

    <!-- cliente -->
    <input list="clientes" name="cliente_nome" class="form-control mb-3" placeholder="Digite o nome do cliente" required>
    <datalist id="clientes">
        <?php while($c = $clientes->fetch_assoc()) { ?>
            <option value="<?= $c['nome'] ?>">
        <?php } ?>
    </datalist>

    <!-- itens -->
    <table class="table">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço unitario</th>
                <th>Ação</th>
            </tr>
        </thead>
    <tbody id="itens"></tbody>
    </table>

    <button type="button" onclick="adicionarItem()" class="btn btn-secondary mb-3">
        + Adicionar Item
    </button>

    <br>

    <button type="submit" class="btn btn-success">Salvar Pedido</button>
    
</form>
    <a href="dashboard.php" class="btn btn-danger mb-3 mt-3 ">Voltar</a>
</div>

</body>
</html>