<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
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

    <?php include_once('header.php'); ?>

    <div class="container mt-5 mb-5 border border-dark rounded border-3">
        <!-- <span class="border border-dark rounded border-3 "> -->
        <h2 class="table-title text-center ">Detalhes do Produto</h2>
        <div class="row ">
            <div class="col-md-6">
                <?php
                // Inclua o arquivo de configuração do banco de dados
                include_once 'config.php';

                // Verifica se um ID de produto foi fornecido via GET
                if (isset($_GET['id_produto'])) {
                    // Obtém o ID do produto da URL
                    $id_produto = $_GET['id_produto'];

                    // Consulta os detalhes do produto no banco de dados
                    $query = "SELECT * FROM produtos WHERE id_produto = $id_produto";
                    $result = mysqli_query($conn, $query);

                    // Verifica se a consulta foi bem-sucedida
                    if (!$result) {
                        echo "Erro na consulta: " . mysqli_error($conn);
                    }

                    // Verifica se o produto foi encontrado
                    if (mysqli_num_rows($result) > 0) {
                        $produto = mysqli_fetch_assoc($result);
                ?>
                        <img src="<?php echo $produto['imagem']; ?>" class="img-fluid" alt="<?php echo $produto['descricao']; ?>">
                <?php
                    } else {
                        echo "Produto não encontrado.";
                    }
                } else {
                    echo "ID do produto não fornecido.";
                }
                ?>
            </div>
            <div class="col-md-6">
                <?php
                // Verifica se o produto foi encontrado no banco de dados
                if (isset($produto)) {
                ?>
                    <div class="card card-body">
                        <h3><?php echo $produto['descricao']; ?></h3>
                        <p><?php echo $produto['detalhes']; ?></p>
                        <p><strong>Preço:</strong> R$ <?php echo number_format($produto['preco_venda'], 2, ',', '.'); ?></p>
                        <form method="get" action="carrinho.php">
                            <input type="hidden" name="id_produto" value="<?php echo $produto['id_produto']; ?>">
                            <div class="form-group">
                                <label for="tamanho">Tamanho:</label>
                                <select class="form-control" id="tamanho" name="tamanho">
                                    <option value="P">P</option>
                                    <option value="M">M</option>
                                    <option value="G">G</option>
                                </select>
                                <label for="quantidade">Quantidade:</label>
                                <input type="number" class="form-control" id="quantidade" name="quantidade" value="1" min="1">
                            </div>
                            <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
                        </form>
                    <?php
                }
                    ?>
                    </div>
            </div>
        </div>
    </div>
    <?php include_once('footer.php'); ?>

</body>

</html>