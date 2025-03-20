<?php
// Inclua aqui a conexão com o banco de dados e a verificação de sessão/login
function getInfoCliente($id_cliente)
{
    global $conn;
    $query = "SELECT * FROM clientes WHERE id_cliente = $id_cliente";
    $result = mysqli_query($conn, $query);
    $info = mysqli_fetch_assoc($result);
    return $info;
}

require_once('validarLogin.php');
require_once('header.php');

// Verifica se uma sessão está ativa
if (session_status() == PHP_SESSION_NONE) {
    // Inicia a sessão apenas se não estiver ativa
    session_start();
}

// Se as variáveis de sessão NÃO estiverem definidas, redireciona para a página de login
if (!isset($_SESSION['id_cliente']) || !isset($_SESSION['email'])) {
    header("Location: cat_login.php");
    die();
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Perfil do Usuário</title>
    <!-- Adicione as seguintes linhas para incluir as bibliotecas do Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- Inclui o link para a fonte Roboto da Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">

    <!-- Inclui estilos personalizados -->

    <link rel="stylesheet" href="style.css">
</head>
<header>Minha Conta</header>

<body>

    <div class="row justify-content-center container-fluid mt-8">
        <div class="col-md-4">
            <!-- Informações do Perfil -->
            <div class="card">
                <div class="card-header">
                    Informações do Perfil
                </div>
                <div class="card-body">
                    <!-- Exiba aqui as informações do perfil do usuário -->
                    <?php
                    $info = getInfoCliente($_SESSION['id_cliente']);
                    echo '<p>Nome: ' . $info['nome'] . '</p>';
                    echo '<p>Email: ' . $_SESSION['email'] . '</p>';
                    echo '<p>Endereço: ' . $info['endereco'] . '</p>';
                    echo '<p>Telefone: ' . $info['celular'] . '</p>';
                    echo ' <p>CPF: ' . $info['cpf'] . '</p>';
                    echo ' <p>Data de Nascimento: ' . $info['dtnascimento'] . '</p>';
                    echo ' <a href="cat_editarperfil.php?id_cliente=' . $info['id_cliente'] . ' " class="btn btn-primary">Editar Perfil</a>';
                    ?>
                </div>
            </div>
        <!-- Chat do Whatsapp -->
        <div class="card mt-4">
            <div class="card-header">
                Chat do Whatsapp
            </div>
            <div class="card-body">
                <!-- Integre aqui a API do Whatsapp para o chat -->
                <!-- Substitua o link abaixo pelo link da API do Whatsapp -->
                <a href="https://api.whatsapp.com/send?phone=5521987654321" class="btn btn-success" target="_blank">
                    Iniciar Chat
                </a>
            </div>
        </div>
        </div>
        <div class="col-md-6">
            <!-- Histórico de Pedidos -->
            <div class="conteiner-fluid">
                <div class="container-header">
                    <h2 class='text-center mt-4 '>Histórico de Pedidos</h2>
                </div>
                <div class="container">
                    <?php
                    $id_cliente = $_SESSION['id_cliente'];  // Certifique-se de que a sessão está sendo tratada em outro lugar

                    $sql = "SELECT pedidos.*, GROUP_CONCAT(CONCAT(produtos.descricao, ' (', carrinho.quantidade, ')') SEPARATOR ', ') AS produtos, GROUP_CONCAT(pedidos_pagamentos.tipo_pagamento SEPARATOR ', ') AS tipos_pagamento
                    FROM pedidos
                    LEFT JOIN carrinho ON pedidos.id_pedido = carrinho.id_pedido
                    LEFT JOIN pedidos_pagamentos ON pedidos.id_pedido = pedidos_pagamentos.id_pedido
                    LEFT JOIN produtos ON carrinho.id_produto = produtos.id_produto
                    WHERE pedidos.id_cliente = $id_cliente
                    GROUP BY pedidos.id_pedido
                    ORDER BY pedidos.dt_criacao DESC";
                
                $result = $conn->query($sql);
                
                // Exibir os resultados na forma de histórico
                if ($result->num_rows > 0) {
                    // echo "<div class='container mt-4'>";
                    echo "<table class='table table-bordered'>
                <thead class='thead-dark'>
                <tr>
                    <th>ID do Pedido</th>
                    <th>Data de Criação</th>
                    <th>Data de Entrega</th>
                    <th>Código de Rastreamento</th>
                    <th>Produtos</th>
                    <th>Total do Pedido</th>
                </tr>
                </thead>
                <tbody>";
                
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                <td>" . $row['id_pedido'] . "</td>
                <td>" . $row['dt_criacao'] . "</td>
                <td>" . $row['dt_entrega'] . "</td>
                <td>" . $row['cod_rastreamento'] . "</td>
                <td>" . $row['produtos'] . "</td>
                <td>" . 'R$ ' . number_format($row['total_pedido'], 2, ',', '.') . "</td>
                </tr>";
                    }
                
                    echo "</tbody></table></div>";
                } else {
                    echo "<div class='container mt-4'>Nenhum pedido encontrado.</div>";
                }
                
                // Feche a conexão (se estiver utilizando a conexão do arquivo config.php)
                $conn->close();
                ?>
            </div>
            </div>
        </div>
    </div>
</body>
<?php include_once('footer.php'); ?>

</html>