<?php
// Iniciar a sessão
session_start();

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
    // Obter os dados do formulário
    $input_cpf = $_POST["cpf"];
    $input_password = $_POST["password"];

    // Consulta SQL para verificar as credenciais
    $sql = "SELECT id, cpf, senha_sistema FROM advogados WHERE cpf = '$input_cpf'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // CPF encontrado, verificar a senha
        $row = $result->fetch_assoc();
        if ($input_password === $row["senha_sistema"]) {
            // Autenticação bem-sucedida
            // Redirecionar para a página de boas-vindas ou fazer qualquer outra ação necessária
            $_SESSION["loggedin"] = true;
            $_SESSION["advogado_id"] = $row["id"];
            header("location: menu.html");
        } else {
            // Autenticação falhou
            $login_err = "CPF ou senha inválidos.";
        }
    } else {
        // CPF não encontrado
        $login_err = "CPF ou senha inválidos.";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img\icon redondo logo.png">
    <title>Login</title>
    <link rel="stylesheet" href="/css/style-login.css">
</head>
<body>
    <div class="container">
        <div class="img-container">
            <img src="img\logo principal.png" alt="">
        </div>
        <div class="conteudo-container">

            <h1>Entrar</h1>


            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    <label for="cpf">CPF:</label>
                    <input type="text" name="cpf" id="cpf" required>
                </div>
                <div>
                    <label for="password">Senha:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="links-opcoes">
                    <div>
                        <a href="recuperarsenha.php">Esqueceu a senha?</a>
                    </div>
                </div>
                <div>
                    <input type="submit" value="Login">
                </div>
            </form>
            <div class="links-opcoes">
                <div>
                    <p>Novo cadastro? <a class = "cadatsro" href="http://localhost/novo-adv.html"><span>Registrar</span></a></p>
                </div>
            </div>
        </div>
        <?php
        // Exibir mensagem de erro, se houver
        if (isset($login_err)) {
            echo "<p class='error'>$login_err</p>";
        }
        ?>
    </div>
</body>
</html>

