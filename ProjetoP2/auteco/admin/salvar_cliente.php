<?php
session_start();

if (!isset($_SESSION["logado"])) {
    header("Location: login.php");
    exit;
}
include("conexao.php");

function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        $soma = 0;
        for ($i = 0; $i < $t; $i++) {
            $soma += $cpf[$i] * (($t + 1) - $i);
        }
        $digito = ((10 * $soma) % 11) % 10;

        if ($cpf[$t] != $digito) {
            return false;
        }
    }

    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];

    if (!validarCPF($cpf)) {
        echo "<div class='alert alert-danger text-center mt-5'>
                CPF inválido!
              </div>";
        exit;
    }

        $cpf = preg_replace('/[^0-9]/', '', $cpf);

    $stmt = $conn->prepare("SELECT id FROM clientes WHERE cpf = ?");
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='alert alert-warning text-center mt-5'>
                CPF já cadastrado!
            </div>";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO clientes (nome, cpf, telefone, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $cpf, $telefone, $email);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center mt-5'>
                Cliente cadastrado com sucesso!
              </div>";
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}

?>