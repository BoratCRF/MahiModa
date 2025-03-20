<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Mahi Moda - Roupas Africanas, moda fashion e religiosa. </title>
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


<body class="background">
  <?php include_once("header.php"); ?>
  <!-- Js -->
  <header> </header>

  <!-- Abetura de div para carousel -->
  <div class="container">
    <div id="carousel" class="carousel slide " data-bs-ride="carousel" style="width: 1200px; height: 600px; z-index: 1;">
      <div class="carousel-inner ">
        <!-- carousel 1 -->
        <div class="carousel-item active">
          <img src="img/frete.jpg" class="d-block w-100 h-100 img-fluid" alt="Imagem 1">
        </div>
        <!-- carousel 2 -->
        <div class="carousel-item ">
          <img src="img/Grupo2.jpg" class="d-block w-100 h-100 img-fluid" alt="Imagem 2">
        </div>
        <!-- carousel 2 -->
        <div class="carousel-item ">
          <img src="img/grupo3.jpg" class="d-block w-100 h-100 img-fluid" alt="Imagem 3">
        </div>
        <!-- botão  -->
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Próximo</span>
      </button>
    </div>
  </div>

  <!-- abertura de div para card -->
  <div class="container">
    <!-- Card 1 -->
    <div class="card">
      <img src="img/roupa.feminino.jpg" alt="Roupa Africana 1">
      <div class="card-content">
        <h2 class="card-title"> Moda Feminina </h2>
        <p class="card-description">
          Descubra a elegância e o estilo único da Africa, feitas para realçar a beleza de cada mulher.
           Encontre peças exclusivas que vão transformar o seu visual e elevar a sua confiança.</p>
        <a href="cat_feminino.php">Ver mais</a>
      </div>
    </div>
    <!-- Card 2 -->
    <div class="card">
      <img src="img/roupa.masculina.jpg" alt="Roupa Africana 2">
      <div class="card-content">
        <h2 class="card-title"> Moda Masculina </h2>
        <p class="card-description">Descubra nossa coleção exclusiva de roupas masculinas, 
          com designs Africano modernos e elegantes para homens que buscam estilo e conforto..</p>
        <a href="cat_masculino.php">Ver mais</a>
      </div>
    </div>
    <!-- Card 3 -->
    <div class="card">
      <img src="img/acessorio.africano.jpg" alt="Roupa Africana 3">
      <div class="card-content">
        <h2 class="card-title"> Acessórios </h2>
        <p class="card-description">Descubra nossa coleção de acessórios exclusivos que vão transformar seu look e adicionar um toque de estilo único à sua vida.</p>
        <a href="cat_acessorio.php">Ver mais</a>
      </div>
    </div>
  </div>
</body>
<!-- incluindo em php o arquivo footer -->
<?php include_once('footer.php'); ?>

</html>