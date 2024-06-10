<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style-rec.senha.css">
    <link rel="icon" href="img\icon redondo logo.png">
    <title>Recuperar Senha</title>
</head>
<body>
    <?php
    // Configurações do banco de dados
    $servername = "localhost"; // Nome do servidor
    $username = "root"; // Nome de usuário do banco de dados
    $password = ""; // Senha do banco de dados
    $dbname = "conexao_cadastro"; // Nome do banco de dados
    
    // Criar conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Verificar se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar se o CPF está vazio (esta verificação pode ser removida se o campo for obrigatório no HTML)
        if (!empty($_POST["cpf"])) {
            // Obter o CPF enviado pelo formulário
            $cpf = $_POST["cpf"];

            // Consulta SQL para verificar se o CPF existe na tabela
            $sql = "SELECT * FROM advogados WHERE cpf = '$cpf'";
            $resultado = $conn->query($sql);

            // Verificar se o resultado possui alguma linha (ou seja, se o CPF existe no banco de dados)
            if ($resultado->num_rows > 0) {
                // O CPF existe
                // Exibir mensagem de sucesso
                echo "<p>Email para redefinição de senha enviado para o seu endereço.</p>";
            }
        }
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="container">
    <h2>Recuperar Senha</h2>
    <div class="conteudo-container">
        <div>
            <label for="cpf">Digite seu CPF:</label>
            <input type="text" name="cpf" id="cpf">
        </div>
        <div>
            <input type="submit" value="Enviar">
        </div>
    </div>
    </div>
    </form>
</body>
</html>
