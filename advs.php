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

// Consulta SQL para selecionar todos os clientes
$sql = "SELECT * FROM advogados";
$result = $conn->query($sql);

// Verifica se há resultados
if ($result->num_rows > 0) {
    // Exibe os dados de cada cliente
    while($row = $result->fetch_assoc()) {
        echo "ID advogado: " . $row["id"]. "<br>";
        echo "Nome Completo: " . $row["nome"]. "<br>";
        echo "Especialização: " . $row["especializacao"]. "<br>";
        echo "Número OAB: " . $row["numero_oab"]. "<br>";
        echo "Endereço: " . $row["endereco"]. "<br>";
        echo "Telefone: " . $row["telefone"]. "<br>";
        echo "Email: " . $row["email"]. "<br>";
        echo "Data de Nascimento: " . $row["data_nascimento"]. "<br>";
        echo "Data de Admissão: " . $row["data_admissao"]. "<br>";
        echo "Estado Civil: " . $row["estado_civil"]. "<br>";
        echo "Gênero: " . $row["genero"]. "<br>";
        echo "Nacionalidade: " . $row["nacionalidade"]. "<br>";
        echo "RG: " . $row["rg"]. "<br><br>";
        echo "CPF: " . $row["cpf"]. "<br><br>";
    }
} else {
    echo "0 resultados encontrados";
}

// Fecha a conexão
$conn->close();
?>
