<?php
// Configurações do banco de dados
$servername = "localhost"; // Endereço do servidor do banco de dados
$username = "root"; // Nome de usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "conexao_cadastro"; // Nome do banco de dados

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Obtém os dados do formulário
$nome_completo = $_POST['nome_completo'];
$tipo_cliente = $_POST['tipo_cliente'];
$dt_nasc = $_POST['dt_nasc'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$rua = $_POST['rua'];
$num = $_POST['num'];

// Prepara e executa a consulta SQL para inserir os dados
$sql = "INSERT INTO novo_cliente (nome_completo, tipo_cliente, dt_nasc, email, tel, cpf, rg, bairro, cidade, rua, num)
        VALUES ('$nome_completo', '$tipo_cliente', '$dt_nasc', '$email', '$tel', '$cpf', '$rg', '$bairro', '$cidade', '$rua', '$num')";

if ($conn->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso";
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}

// Fecha a conexão
$conn->close();
?>
