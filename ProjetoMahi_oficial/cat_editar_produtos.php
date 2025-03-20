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


if (isset($_GET['id_produto']) && !empty($_GET['id_produto'])) {
    $id_produto = $_GET['id_produto'];

    // Realizar a consulta no banco de dados para obter os dados da tarefa com o ID fornecido
    $consulta = "SELECT * FROM produtos WHERE id_produto = $id_produto";
    $resultado = $conn->query($consulta);

    // Verificar se a consulta retornou resultados
    if ($resultado->num_rows > 0) {
        // Obter os dados da tarefa
        $produtos = $resultado->fetch_assoc();
    } else {
        // Redirecionar para a página principal se a tarefa não for encontrada
        header("Location: cat_produtos.php");
        exit();
    }
} else {
    // Redirecionar para a página principal se o ID não for fornecido
    header("Location: cat_produtos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Editor de Produtos</title>
    <link rel="shortcut icon" href="img/art_logo.svg" type="image/x-icon">
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
<header>Editor de produtos</header>

    <div class="container pt-1 shadow-sm bg-white">
        <div class="row mt-2">
            <div class="form-group col-md-16">
                <form action="admin.php" method="post" enctype="multipart/form-data">
                    <!-- Adicione um campo hidden para armazenar o ID do usuário -->
                    <input type="hidden" name="id_produto" value="<?= $produtos['id_produto'] ?>">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="descricao">Nome do Produto</label>
                            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="descricao" value="<?= $produtos['descricao'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="preco_custo">Preco de custo</label>
                            <input type="text" class="form-control" id="preco_custo" name="preco_custo" placeholder="preco_custo" value="<?= $produtos['preco_custo'] ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="preco_venda">Preço de venda</label>
                            <input type="text" class="form-control" id="preco_venda" name="preco_venda" placeholder="preco_venda" value="<?= $produtos['preco_venda'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="estoque">Estoque</label>
                            <input type="number" class="form-control" id="estoque" name="estoque" value="<?= $produtos['estoque'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="categoria">Categoria:</label>
                            <select class="form-control" id="categoria" name="categoria" required>>
                                <option value="1" <?= $produtos['categoria'] == 1 ? 'selected' : '' ?>>Roupas Femininas</option>
                                <option value="2" <?= $produtos['categoria'] == 1 ? 'selected' : '' ?>>Roupas Masculinas</option>
                                <option value="3" <?= $produtos['categoria'] == 1 ? 'selected' : '' ?>>Acessórios</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="detalhes">Detalhes</label>
                            <input type="text" class="form-control" id="detalhes" name="detalhes" placeholder="detalhes">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="imagem" class="form-label">imagem (upload da imagem):</label>
                            <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="imagem_preview" class="form-label">Preview da imagem:</label>
                            <img src="<?= isset($produtos['imagem']) ? str_replace(' ', '_', $produtos['imagem']) : 'img/userpadrao.png' ?>" alt="Preview da imagem" id="imagem_preview" name="imagem_preview" class="img-fluid w-251 h-251 border">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary" name="edit_produto">Salvar</button>
                            <a href="cat_produtos.php" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- Bootstrap JS (opcional, necessário apenas para funcionalidades avançadas) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Inclui o rodapé dinamicamente -->
</body>
<?php include_once('footer.php'); ?>
</html>