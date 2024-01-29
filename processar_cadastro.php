<?php
// Configurações do banco de dados
$hostname = "localhost";
$username = "root";
$password = "";
$database = "test";

// Conecta ao banco de dados
$conn = new mysqli($hostname, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se os dados do formulário foram enviados
if (isset($_POST['email'], $_POST['senha'], $_POST['confirma_senha'])) {
    // Obtém dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];

    // Verifica se as senhas coincidem
    if ($senha !== $confirma_senha) {
        die("As senhas não coincidem.");
    }

    // Hash da senha (nunca armazene senhas em texto puro no banco de dados)
    $hashed_senha = password_hash($senha, PASSWORD_DEFAULT);

    // Insere dados no banco de dados
    $sql = "INSERT INTO legal (email, senha) VALUES ('$email', '$hashed_senha')";

    if ($conn->query($sql) === TRUE) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir dados: " . $conn->error;
    }
} else {
    echo "Dados do formulário não foram recebidos corretamente.";
}

// Fecha a conexão
$conn->close();
?>


