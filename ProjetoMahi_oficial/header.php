<?php
session_start();
require_once ('config.php');
require_once ('admin.php');
require_once ('validarLogin.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<body>

<header>Frete grátis para compras a partir de R$150,00</header>
<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
  <div class="container-fluid row-3">
    <a class="navbar-brand" href="#"></a>
    <img src="img/logo3.0.png" alt="Logo" width="150" height="150" class="d-inline-block align-text-top">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php"> Home </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="cat_sobre.php"> Sobre </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categoria
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="cat_feminino.php"> Feminino </a></li>
            <li><a class="dropdown-item" href="cat_masculino.php"> Masculino </a></li>
            <li><a class="dropdown-item" href="cat_acessorio.php"> Acessórios </a></li>
          </ul>
      </ul>
      <form class="d-flex mx-auto" role ="search" method="GET" action="pesquisar.php">
    <input class="form-control justify-content-center mr-s me-2" type="search" name="query" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-dark" type="submit">Pesquisar</button>
</form>

<div id="resultadoPesquisa"></div>

<script>
    // Função para enviar a solicitação de pesquisa via AJAX e exibir os resultados
    function pesquisar() {
        var query = document.querySelector('input[name="query"]').value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("resultadoPesquisa").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "pesquisar.php?query=" + query, true);
        xhttp.send();
    }

    // Executar a função de pesquisa quando o formulário for enviado
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio do formulário padrão
        pesquisar(); // Chama a função de pesquisa
    });
</script>
<?php
      if (isset($_SESSION['id_cliente']) && isset($_SESSION['email'])) {
        if ($_SESSION['id_cliente'] == 1) {
          include_once 'usuario_bd.php'; 
        }
        // Sessão ativa, exibe botão de logout
        echo '<li class="nav-item btn rounded btn-outline-success ml-2 mr-s me-2"> <a class="nav-link" href="cat_carrinho.php">Carrinho</a>';
        echo '<li class="nav-item btn rounded btn-outline-success ml-2 mr-s me-2"> <a class="nav-link" href="cat_perfil.php">Minha Conta</a>';
        echo '<li class="nav-item btn rounded btn-outline-danger ml-2 mr-s me-2"> <a class="nav-link" href="logout.php">Logout</a>';
      } elseif (isset($_SESSION['id']) && isset($_SESSION['email'])) {
        if ($_SESSION['id'] == 1) {
          include_once 'admin.php'; 
        }

        // Sessão ativa, exibe botão de logout
        echo '<li class="nav-item btn rounded btn-outline-success ml-2 mr-s me-2"> <a class="nav-link" href="cat_adm.php">Admin</a>';
        echo '<li class="nav-item btn rounded btn-outline-danger ml-2 mr-s me-2"> <a class="nav-link" href="logout.php">Logout</a>';
      } else {
                // Sessão não ativa, exibe botões de login e cadastro
                echo '<ul class="navbar-nav ml-auto">';
                echo '<li class="nav-item btn rounded btn-outline-success justify-content-end"> <a class="nav-link" href="cat_login.php">Login</a>';
                echo '<li class="nav-item btn rounded btn-outline-success justify-content-end mx-2"> <a class="nav-link" href="cat_cadastro.php">Cadastro</a>';
                echo '</ul>';
      }
      ?>
    </div>
  </div>
</nav>