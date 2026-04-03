<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Cliente</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card mt-5 p-4 shadow">
                <h3 class="text-center mb-4">Cadastro de Cliente</h3>

                <form action="salvar_cliente.php" method="POST">

                    <input type="text" name="nome" class="form-control mb-3" placeholder="Nome" required>
                    <input type="text" name="cpf" class="form-control mb-3" placeholder="CPF" required>
                    <input type="text" name="telefone" class="form-control mb-3" placeholder="Telefone">
                    <input type="email" name="email" class="form-control mb-3" placeholder="Email">

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

</body>
</html>