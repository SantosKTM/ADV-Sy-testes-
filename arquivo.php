<?php

// Configurações de conexão com o banco de dados
$servername = "localhost"; // Endereço do servidor MySQL
$username = "root"; // Nome de usuário do MySQL
$password = ""; // Senha do MySQL
$dbname = "conexao_cadastro"; // Nome do banco de dados

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    // Conectar ao banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Preparar os dados do arquivo para inserção no banco de dados
    $file_name = $_FILES["file"]["name"];
    $file_tmp = $_FILES["file"]["tmp_name"];
    $file_type = $_FILES["file"]["type"];
    $file_size = $_FILES["file"]["size"];
    $file_error = $_FILES["file"]["error"];

    // Verificar se não há erros no upload
    if ($file_error === 0) {
        // Ler o conteúdo do arquivo
        $file_content = file_get_contents($file_tmp);

        // Preparar a query para inserir o arquivo no banco de dados
        $sql_insert_file = "INSERT INTO arquivos (nome, tipo, tamanho, conteudo) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_insert_file);
        $stmt->bind_param("ssis", $file_name, $file_type, $file_size, $file_content);

        // Executar a query para inserir o arquivo
        if ($stmt->execute()) {
            echo "Arquivo enviado e armazenado com sucesso no banco de dados.";
        } else {
            echo "Erro ao armazenar o arquivo no banco de dados: " . $stmt->error;
        }

        // Fechar a declaração
        $stmt->close();
    } else {
        echo "Erro no upload do arquivo.";
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivo</title>
</head>
<body>
    <h2>Enviar Arquivo</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <input type="submit" value="Enviar Arquivo">
    </form>
</body>
</html>
