<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("conexao.php");
// Verificação de usuario e senha
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($senha == $user["senha"]) {
            
            $_SESSION["logado"] = true;
            $_SESSION["usuario"] = $usuario;

            header("Location: dashboard.php");
            exit;

        } else {
            echo "Senha incorreta";
        }

    } else {
        echo "Usuário não encontrado";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card p-4 shadow">
                <h3 class="text-center mb-3">Login</h3>

                <?php if(isset($erro)) { ?>
                    <div class="alert alert-danger"><?= $erro ?></div>
                <?php } ?>

                <form method="POST">

                    <input type="text" name="usuario" class="form-control mb-3" placeholder="Usuário" required>

                    <input type="password" name="senha" class="form-control mb-3" placeholder="Senha" required>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

</body>
</html>