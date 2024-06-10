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

// Query para selecionar os arquivos armazenados
$sql_select_arquivos = "SELECT id, nome, tipo, tamanho FROM arquivos";

// Executar a query dos arquivos
$result_arquivos = $conn->query($sql_select_arquivos);

// Verificar se há resultados dos arquivos
if ($result_arquivos->num_rows > 0) {
    // Exibir os arquivos em uma lista
    echo "<h2>Arquivos Armazenados:</h2>";
    echo "<ul>";
    while($row = $result_arquivos->fetch_assoc()) {
        echo "<li><a href='download.php?id=" . $row["id"] . "'>" . $row["nome"] . "</a> (" . $row["tipo"] . ", " . $row["tamanho"] . " bytes)</li>";
    }
    echo "</ul>";
} else {
    echo "Nenhum arquivo armazenado.";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
