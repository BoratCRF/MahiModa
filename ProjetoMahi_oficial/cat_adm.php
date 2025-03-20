<?php
require_once('validarLogin.php');
require_once('header.php');

// Verifica se uma sessão está ativa
if (session_status() == PHP_SESSION_NONE) {
    // Inicia a sessão apenas se não estiver ativa
    session_start();
}

// Se as variáveis de sessão NÃO estiverem definidas, redireciona para a página de login
if (!isset($_SESSION['id']) || !isset($_SESSION['email'])) {
    header("Location: cat_login.php");
    die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Área de Administração</title>
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

<body>
<header>Admininstração</header>
    <div class="table-container mt-5">
        <div class="row table-responsive">
            <div class="col-md-8 offset-md-2">
                <h2>Área de Administração</h2>
                <div class="list-group ">
                    <!-- Botão para a página de adição de administradores -->
                    <a href="cat_listaradm.php" class="list-group-item list-group-item-action">Listar Administradores</a>
                    <!-- Botão para a página de adição de administradores -->
                    <a href="cat_novoadm.php" class="list-group-item list-group-item-action">Adicionar Administrador</a>
                    <!-- Botão para a área de produtos -->
                    <a href="cat_produtos.php" class="list-group-item list-group-item-action">Área de Produtos</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Adicione a ligação para o Bootstrap JS e jQuery (opcional, mas necessário para alguns recursos do Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
<?php include_once('footer.php'); ?>
</html>
