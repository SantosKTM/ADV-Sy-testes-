<?php

session_start(); // Iniciar a sessão

// Função para recarregar a página atual
function reloadPage() {
    header("Refresh:0"); // Redireciona para a mesma página após 0 segundos
}

// Verificar se o formulário de cadastro de advogado foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_advogado"])) {
    // Processar o formulário de cadastro de advogado (insira os dados no banco de dados, etc.)
    // Aqui você iria inserir os dados do novo advogado no banco de dados

    // Após o cadastro, recarregar a página para atualizar a caixa de seleção de advogados
    reloadPage();
}

// Verificar se o formulário de cadastro de cliente foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_cliente"])) {
    // Processar o formulário de cadastro de cliente (insira os dados no banco de dados, etc.)
    // Aqui você iria inserir os dados do novo cliente no banco de dados

    // Após o cadastro, recarregar a página para atualizar a caixa de seleção de clientes
    reloadPage();
}

// Verificar se o formulário de cadastro de caso foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_caso"])) {
    // Conectar ao banco de dados
    $servername = "localhost"; // Endereço do servidor MySQL
    $username = "root"; // Nome de usuário do MySQL
    $password = ""; // Senha do MySQL
    $dbname = "conexao_cadastro"; // Nome do banco de dados

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Obter os dados do formulário
    $advogado = $_POST["advogado"];
    $cliente = $_POST["cliente"];
    $descricao = $_POST["descricao"];
    $data_abertura = $_POST["data_abertura"];
    $data_encerramento = $_POST["data_encerramento"];
    $status = isset($_POST["status"]) ? $_POST["status"] : "Aberto"; // Definir como "Aberto" por padrão

    // Query para obter o ID do advogado
    $sql_id_advogado = "SELECT id FROM advogados WHERE nome='$advogado'";
    $result_id_advogado = $conn->query($sql_id_advogado);

    if ($result_id_advogado->num_rows > 0) {
        $row = $result_id_advogado->fetch_assoc();
        $id_advogado = $row["id"];

        // Query para obter o ID do cliente
        $sql_id_cliente = "SELECT id_cliente FROM novo_cliente WHERE nome_completo='$cliente'";
        $result_id_cliente = $conn->query($sql_id_cliente);

        if ($result_id_cliente->num_rows > 0) {
            $row = $result_id_cliente->fetch_assoc();
            $id_cliente = $row["id_cliente"];

            // Query para inserir o caso no banco de dados
            $sql_insert_caso = "INSERT INTO casos (id_cliente, id_advogado, descricao, data_abertura, data_encerramento, status) VALUES ($id_cliente, $id_advogado, '$descricao', '$data_abertura', '$data_encerramento', '$status')";

            if ($conn->query($sql_insert_caso) === TRUE) {
                echo "Caso cadastrado com sucesso!";
            } else {
                echo "Erro ao cadastrar o caso: " . $conn->error;
            }
        } else {
            echo "ID do cliente não encontrado.";
        }
    } else {
        echo "ID do advogado não encontrado.";
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}

// Função para criar caixa de seleção
function createSelect($name, $options) {
    echo '<select name="' . $name . '">';
    foreach ($options as $option) {
        echo '<option value="' . $option . '">' . $option . '</option>';
    }
    echo '</select>';
}

// Configurações de conexão com o banco de dados
$servername = "localhost"; // Endereço do servidor MySQL
$username = "root"; // Nome de usuário do MySQL
$password = ""; // Senha do MySQL
$dbname = "conexao_cadastro"; // Nome do banco de dados

// Conectando ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Query para selecionar os nomes dos advogados
$sql_advogados = "SELECT nome FROM advogados";

// Executando a query dos advogados
$result_advogados = $conn->query($sql_advogados);

// Verificar se há resultados dos advogados
if ($result_advogados->num_rows > 0) {
    // Criar array com os nomes dos advogados
    $advogados = [];
    while($row = $result_advogados->fetch_assoc()) {
        $advogados[] = $row["nome"];
    }
    // Remover duplicatas
    $advogados = array_unique($advogados);
} else {
    $advogados = ["Nenhum advogado cadastrado"];
}

// Query para selecionar os nomes dos clientes
$sql_clientes = "SELECT nome_completo FROM novo_cliente";

// Executando a query dos clientes
$result_clientes = $conn->query($sql_clientes);

// Verificar se há resultados dos clientes
if ($result_clientes->num_rows > 0) {
    // Criar array com os nomes dos clientes
    $clientes = [];
    while($row = $result_clientes->fetch_assoc()) {
        $clientes[] = $row["nome_completo"];
    }
    // Remover duplicatas
    $clientes = array_unique($clientes);
} else {
    $clientes = ["Nenhum cliente cadastrado"];
}

// Fechando a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <form method="post">
        <h2>Cadastro de Casos</h2>
        <label for="advogado">Advogado Responsável: </label>
        <?php createSelect("advogado", $advogados); ?><br><br>
        <label for="cliente">Cliente: </label>
        <?php createSelect("cliente", $clientes); ?><br><br>
        
        <label for="descricao">Descrição: </label>
        <textarea name="descricao" id="descricao" cols="30" rows="1"></textarea> <br><br>

        <label for="data_abertura">Data de Abertura: </label>
        <input type="date" name="data_abertura" id="data_abertura"> <br><br>

        <label for="data_encerramento">Data de Encerramento: </label>
        <input type="date" name="data_encerramento" id="data_encerramento"><br><br>

        <label for="status">Status: </label><br>
        <input type="radio" name="status" value="Aberto" id="aberto">
        <label for="aberto">Aberto</label><br>
        <input type="radio" name="status" value="Fechado" id="fechado">
        <label for="fechado">Fechado</label><br><br>
        <input type="submit" name="submit_caso" value="Cadastrar">
    </form>
</body>
</html>
