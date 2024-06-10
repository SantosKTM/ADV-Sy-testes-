<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "conexao_cadastro";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se há um termo de busca
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// Consulta SQL para selecionar clientes com base no termo de busca
$sql = "SELECT * FROM novo_cliente WHERE 
        nome_completo LIKE '%$search%' OR 
        tipo_cliente LIKE '%$search%' OR 
        data_cadastro LIKE '%$search%' OR 
        dt_nasc LIKE '%$search%' OR 
        email LIKE '%$search%' OR 
        tel LIKE '%$search%' OR 
        cpf LIKE '%$search%' OR 
        rg LIKE '%$search%' OR 
        bairro LIKE '%$search%' OR 
        cidade LIKE '%$search%' OR 
        rua LIKE '%$search%' OR 
        num LIKE '%$search%'";

$result = $conn->query($sql);

// Verifica se há resultados
?>
<!DOCTYPE html>
<html>
<head>
    <title>Clientes Cadastrados</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: "poppins", sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin-top: 50px;
            margin-left: 50px;
        }

        .container a img {
            width: 60px;
        }

        h1 {
            color: black;
            border-radius: 5px;
            text-align: left;
            margin-bottom: 10px;
            font-weight: 500;
        }
        table {
            width: 1800px;
            border-collapse: collapse;
            overflow-x: auto;
            display: block;
        }
        table, th, td {
            border-bottom: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: white;
            color: black;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .pesquisar {
            margin-bottom: 20px;
        }

        .pesquisar form {
            display: flex;
        }

        .pesquisar input[type="text"] {
            font-family: "poppins", sans-serif;
            font-size: 18px;
            width: 250px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
        }

        .pesquisar button {
            font-family: "poppins", sans-serif;
            font-size: 18px;
            padding: 10px;
            border: none;
            background: #5EA3E2;
            color: white;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s;
            margin-left: 10px;
            text-align: center;
            width: 100px;
        }

        .pesquisar button:hover {
            background-color: #2D6192;
        }

        .topo {
            display: flex; 
            align-items: center; 
            margin-top: 20px;
            margin-bottom: 15px;
        }

        .topo a img {
            margin-left: 10px;
            padding-top: 20px;
            width: 30px;
        }

        .topo h1 {
            margin-right: 10px;
        }

        .container button {
            border: none;
            cursor: pointer;
            margin-right: 5px;
        }

        .container button img {
            width: 35px; 
        }

        .container div {
            display: flex;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Fundo semi-transparente */
            z-index: 9999; /* Coloca a tela de sobreposição sobre o conteúdo */
            justify-content: center;
            align-items: center;
        }


    </style>
</head>
<body>
    
<div class="container">
    <a href="formularios.html"><img src="img\botao-home.png" alt=""></a>
    
    <div class="topo">
        <h1>Clientes</h1>
        <a href="novo-cliente.html"><img src="\img\adicionar-usuario.png" alt=""></a>
    </div>

    
    <div class="pesquisar">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Pesquisar clientes..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit">Buscar</button>
        </form>
    </div>

    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<thead>
                <tr>
                    <th>ID</th>
                    <th>Nome Completo</th>
                    <th>Tipo Cliente</th>
                    <th>Data de Cadastro</th>
                    <th>Data de Nascimento</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>CPF</th>
                    <th>RG</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Rua</th>
                    <th>Número</th>
                    <th></th> 
                </tr>
              </thead>";
              echo "<tbody>";
              while($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td data-label='ID'>{$row['id_cliente']}</td>
                          <td data-label='Nome Completo'>{$row['nome_completo']}</td>
                          <td data-label='Tipo Cliente'>{$row['tipo_cliente']}</td>
                          <td data-label='Data de Cadastro'>{$row['data_cadastro']}</td>
                          <td data-label='Data de Nascimento'>{$row['dt_nasc']}</td>
                          <td data-label='Email'>{$row['email']}</td>
                          <td data-label='Telefone'>{$row['tel']}</td>
                          <td data-label='CPF'>{$row['cpf']}</td>
                          <td data-label='RG'>{$row['rg']}</td>
                          <td data-label='Bairro'>{$row['bairro']}</td>
                          <td data-label='Cidade'>{$row['cidade']}</td>
                          <td data-label='Rua'>{$row['rua']}</td>
                          <td data-label='Número'>{$row['num']}</td>
                          <td data-label='Ações'>
                              <div>
                                  <button type='button' onclick='editRow({$row['id_cliente']})'><img src='lapis.png' alt='Editar'></button>
                                  <button type='button'><img src='excluir.png' alt='Excluir'></button>
                              </div>
                          </td>
                        </tr>";
              }
              echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>Nenhum resultado encontrado.</p>";
    }
    // Fecha a conexão
    $conn->close();
    ?>
</div>



<script>
function editRow(clientId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("overlay-content").innerHTML = this.responseText;
            document.getElementById("overlay").style.display = "flex"; // Exibe a tela de sobreposição
        }
    };
    xhttp.open("GET", "edit.php?id=" + clientId, true);
    xhttp.send();
}

</script>
</body>
</html>
