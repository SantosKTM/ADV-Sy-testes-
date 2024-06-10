<?php
// Configurações do banco de dados
$servername = "localhost"; // Endereço do servidor do banco de dados
$username = "root"; // Nome de usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "conexao_cadastro"; // Nome do banco de dados

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nome = $_POST['nome_completo'];
    $especializacao = $_POST['especializacao'];
    $numero_oab = $_POST['noab'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['dt_nasc'];
    $data_admissao = $_POST['dt_admi'];
    $estado_civil = $_POST['estado_civil'];
    $genero = $_POST['genero'];
    $nacionalidade = $_POST['nacionalidade'];
    $rg = $_POST['rg'];
    $cpf = $_POST['cpf'];
    $senha_sistema = $_POST['senha_sistema'];

    // Conecta ao banco de dados

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Prepara e executa a consulta SQL para inserir os dados na tabela do banco de dados
    $sql = "INSERT INTO advogados (nome, especializacao, numero_oab, endereco, telefone, email, data_nascimento, data_admissao, estado_civil, genero, nacionalidade, rg, cpf, senha_sistema) 
            VALUES ('$nome', '$especializacao', '$numero_oab', '$endereco', '$telefone', '$email', '$data_nascimento', '$data_admissao', '$estado_civil', '$genero', '$nacionalidade', '$rg', '$cpf', '$senha_sistema')";

    // Execute a consulta SQL
    if ($conn->query($sql) === TRUE) {
        echo "Registro inserido com sucesso!";
    } else {
        echo "Erro ao inserir registro: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>