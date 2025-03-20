<?php
    function getCategoriaNome($funcao) {
        switch ($funcao) {
            case 1:
                return 'Roupas femininas';
            case 2:
                return 'Roupas masculinas';
            case 3:
                return 'Acessorios';
            default:
                return 'Desconhecido';
        }
    }


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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Administração</title>
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
<header>Produtos</header>
    <body>
        <h2>Bem-vindo à Página de Administração</h2>
        <a href="cat_adicionar.php" ><i class="bi bi-plus-circle"></i> Adicionar</a>
        <!-- Lista de Produtos Existente -->
        <h3>Produtos Existentes</h3>
        <table class="table table-striped shadow-sm">
            <thead>
                <th>id_produto</th>
                <th>Nome</th>
                <th>Preço de Custo</th>
                <th>Preço de Venda</th>
                <th>Estoque</th>
                <th>Categorias</th>
                <th>detalhes</th>
                <th>Imagem</th>
                <th>Ações</th>
            </thead>
            <?php foreach ($produtos as $produto) : ?>
                <?php echo "<tr>
                <td>{$produto['id_produto']} </td>
                <td>{$produto['descricao']} </td>
                <td>{$produto['preco_custo']} </td>
                <td>{$produto['preco_venda']} </td>
                <td>{$produto['estoque']} </td>
                <td>" . getCategoriaNome($produto['categoria']) . "</td>
                <td>{$produto['detalhes']} </td>
                <td><img src='{$produto['imagem']}' alt='imagem' style='width: 50px; height: 50px;'></td>
                <td>
                    <a href='cat_editar_produtos.php?id_produto=" . $produto['id_produto'] . "' class='btn btn-warning btn-sm'>
                    <i class='bi bi-pencil'></i> Editar
                    </a>
                    <a href='admin.php?acao=excluir&id_produto=" . $produto['id_produto'] . "' class='btn btn-danger btn-sm'
                    onclick='return confirm(\"Tem certeza que deseja excluir este produto?\")'>
                    <i class='bi bi-trash'></i> Excluir</a>
                </td>
            </tr>"; ?>
            <?php endforeach ?>
        </table>

    </body>
    <?php include_once('footer.php'); ?>
</html>