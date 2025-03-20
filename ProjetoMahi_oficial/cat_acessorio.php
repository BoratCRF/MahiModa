<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acessórios</title>
    <!-- Adicione as seguintes linhas para incluir as bibliotecas do Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

<?php 
include_once('header.php');
// require_once ('admin.php');
?>

<main>
      <header>Acessórios</header>
      <section id="produtos">
        <?php
            // Conectar ao banco de dados
            // Executar a consulta SQL para obter a lista de produtos
            // Substitua essas linhas com o código real de conexão e consulta

            $produtos = getAllprodutos($conn);
            $categorias = getAllCategorias($conn); // Substitua isso pela função real que obtém os produtos

            $categoriaDesejada = '3';

            echo '<div class="d-flex">';
            foreach ($produtos as $produto) {
              // Verifica se o produto pertence à categoria desejada
              if ($produto['categoria'] === $categoriaDesejada) {
                  echo '<section class="card produto">';
                  echo '<img src="' . $produto['imagem'] . '" class="img-thumbnail imd-fluid w-100 h-100" alt="' . $produto['descricao'] . '">';
                  echo '<p><strong>' . 'Nome: ' . '</strong>' . $produto['descricao'] . '</p>';
                  echo '<p><strong>' . 'Preço: ' . 'R$: ' . '</strong>' . number_format($produto['preco_venda'], 2) . '</p>';
                  echo '<p><strong>' . 'Estoque: ' . '</strong>' . $produto['estoque'] . '</p>';
                  echo '<p><strong>' . 'Descrição: ' . '</strong>' . $produto['detalhes'] . '</p>';
                  // Verifique se o ID do produto está presente na URL
                  if(isset($produto['id_produto'])) {
                      // Construa o link para adicionar o produto ao carrinho
                      echo '<li class="nav-item btn rounded btn-outline-success ml-2 mr-s me-2">';
                      echo '<a class="nav-link" href="carrinho.php?id_produto=' . $produto['id_produto'] . '">Adicionar Ao Carrinho</a>';
                      echo '</li>';
                  }
                  echo '<li class="nav-item btn rounded btn-outline-danger ml-2 mr-s me-2"> <a class="nav-link" href="cat_detalhes_produtos.php?id_produto=' . $produto['id_produto'] . '">Detalhes</a>';
                  echo '</section>';
              }
          }    
          echo '</div>';
      ?>
      </section>
  </main>

  
   <!-- paginação -->
    <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
    <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="cat_acessorio.php">1</a></li>
        <li class="page-item"><a class="page-link" href="cat_acessorio.php">2</a></li>
        <li class="page-item"><a class="page-link" href="cat_acessorio.php">3</a></li>
        <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
    
    <!-- incluindo em php o arquivo footer -->
<?php include_once('footer.php'); ?>



</body>
</html>