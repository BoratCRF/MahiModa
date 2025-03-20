<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cadastro</title>
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

<?php
// require_once('admin.php');
include_once('header.php');
?>

<body>


<header>Adicionar Produtos</header>
    <div class="container mt-5">
        <!-- <h2>Cadastro</h2> -->
        <form action="admin.php" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="descricao">Nome do Produto</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="descrição" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="preco_custo">Preco de custo</label>
                    <input type="text" class="form-control" id="preco_custo" name="preco_custo" placeholder="preco_custo" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="preco_venda">Preço de venda</label>
                    <input type="text" class="form-control" id="preco_venda" name="preco_venda" placeholder="preco_venda" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="estoque">Estoque</label>
                    <input type="number" class="form-control" id="estoque" name="estoque" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="categoria">Categoria:</label>
                    <select class="form-control" id="categoria" name="categoria" required>>
                        <option value="1">Roupas Femininas</option>
                        <option value="2">Roupas Masculinas</option>
                        <option value="3">Acessórios</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="detalhes">Detalhes</label>
                    <input type="text" class="form-control" id="detalhes" name="detalhes" placeholder="detalhes">
                </div>
                <div class="form-group col-md-6">
                    <label for="imagem" class="form-label">imagem (upload da imagem):</label>
                    <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" onchange="previewImage(this);"> 
               </div>
                <div class="form-group col-md-6">
                    <label for="foto_preview" class="form-label">Preview da imagem:</label>
                    <img src="img/userpadrao.png" alt="Preview da imagem" id="foto_preview" class="img-fluid w-251 h-251 border">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="add_produto">Cadastrar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        // Exemplo de script para visualizar a foto antes de enviar o formulário
        function previewImage(input) {
        var file = input.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('foto_preview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
        
    </script>
    
</body>
<?php include_once('footer.php'); ?>
</html>