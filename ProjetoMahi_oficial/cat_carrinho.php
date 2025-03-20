<?php
    include_once 'config.php';
    include_once 'header.php';
    ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
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
<header>Carrinho de Compras</header>
    <body>
    <div class="container table table-striped shadow-sm">
        <h2>Carrinho de Compras</h2>
        <div class="row justify-content-center container-fluid mt-8">
            <div class="col-md-12">
                <?php
                // Inicia ou resgata a sessão
                if (session_status() == PHP_SESSION_NONE) {
                    // Inicia a sessão apenas se não estiver ativa
                    session_start();
                }
                // Verifica se há produtos no carrinho
                if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
                    echo '<table class="table table-striped shadow-sm ">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Produto</th>';
                    echo '<th scope="col">Nome</th>';
                    echo '<th scope="col">Quantidade</th>';
                    echo '<th scope="col">Preço Unitário</th>';
                    echo '<th scope="col">Preço Total</th>';
                    echo '<th scope="col">Ação</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    // Loop pelos produtos no carrinho
                    foreach ($_SESSION['carrinho'] as $id_produto => $quantidade) {
                        // Consulta o nome do produto no banco de dados
                        $query_produto_nome = "SELECT descricao, imagem, preco_venda FROM produtos WHERE id_produto = $id_produto";
                        $result_produto_nome = mysqli_query($conn, $query_produto_nome);

                        // Verifica se o produto foi encontrado
                        if (mysqli_num_rows($result_produto_nome) > 0) {
                            $row_produto_nome = mysqli_fetch_assoc($result_produto_nome);
                            $produto_nome = $row_produto_nome['descricao'];
                            $produto_preco = $row_produto_nome['preco_venda'];
                            $imagem = $row_produto_nome['imagem'];
                        } else {
                            $produto_nome = "Produto não encontrado";
                        }

                        echo '<tr>';
                        echo '<td><img src="' . $imagem . '" alt="Imagem do produto' . $produto_nome . '" width="75" height="75"></td>';
                        echo '<td>' . $produto_nome . '</td>';
                        echo '<td>' . $quantidade . '</td>';
                        echo '<td>R$ ' . number_format($produto_preco, 2, ',', '.') . '</td>';
                        echo '<td>R$ ' . number_format($produto_preco * $quantidade, 2, ',', '.') . '</td>';                        
                        echo '<td><a href="remover.php?acao=remover&id_produto=' . $id_produto . '" class="btn btn-danger">Remover</a></td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                    echo '<div class="d-grid gap-2 d-md-flex ">';
                    echo '<a href="carrinho.php" class="btn btn-warning" onclick="return confirm(\'Tem certeza de que deseja limpar o carrinho?\');">Limpar Carrinho</a>';
                    echo '<a href="index.php" class="btn btn-primary">Continuar Comprando</a>';
                    echo '<form method="post" action="carrinho.php" onsubmit="return confirm(\'Tem certeza de que deseja finalizar a compra?\');">
                    <input type="hidden" name="finalizar_compra" value="1">
                    <button type="submit" class="btn btn-success">Finalizar Compra</button>
                    </form>';
                    echo '</div>';
                } else {
                    // Se não houver produtos no carrinho
                    echo '<div class="container">';                    
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Produto</th>';
                    echo '<th scope="col">Quantidade</th>';
                    echo '<th scope="col">Preço Unitário</th>';
                    echo '<th scope="col">Preço Total</th>';
                    echo '<th scope="col">Ação</th>';
                    echo '<div class="alert alert-warning">';                       
                    echo '<strong class="alert alert-warning">Atenção!</strong> Nenhum item no carrinho.';
                    echo '</div>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

</body>
<?php include_once('footer.php'); ?>
</html>