<?php

// Configurações de conexão com o banco de dados
$servername = "localhost"; // Endereço do servidor MySQL
$username = "root"; // Nome de usuário do MySQL
$password = ""; // Senha do MySQL
$dbname = "conexao_cadastro"; // Nome do banco de dados

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Query para selecionar os casos cadastrados
$sql_casos = "SELECT * FROM casos";

// Executar a query dos casos
$result_casos = $conn->query($sql_casos);

// Verificar se há resultados dos casos
if ($result_casos->num_rows > 0) {
    echo "<h2>Casos Cadastrados:</h2>";
    // Exibir os casos em uma tabela
    echo "<table border='1'>";
    echo "<tr><th>ID Caso</th><th>ID Cliente</th><th>ID Advogado</th><th>Descrição</th><th>Data de Abertura</th><th>Data de Encerramento</th><th>Status</th></tr>";
    while($row = $result_casos->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_caso"] . "</td>";
        echo "<td>" . $row["id_cliente"] . "</td>";
        echo "<td>" . $row["id_advogado"] . "</td>";
        echo "<td>" . $row["descricao"] . "</td>";
        echo "<td>" . $row["data_abertura"] . "</td>";
        echo "<td>" . $row["data_encerramento"] . "</td>";
        echo "<td>" . $row["status"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum caso cadastrado.";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
