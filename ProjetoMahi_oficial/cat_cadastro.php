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

<body>

  <?php include_once('header.php'); ?>

  <header>Cadastro</header>
  <div class="row container container mt-5">
    <!-- <h2>Cadastro</h2> -->
    <form action="usuario_bd.php" method="post" enctype="multipart/form-data">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="nome">Nome</label>
          <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
        </div>
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group col-md-6">
          <label for="senha">Senha</label>
          <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
        </div>
        <div class="form-group col-md-6">
          <label for="dtnascimento">Data de Nascimento</label>
          <input type="date" class="form-control" id="dtnascimento" name="dtnascimento" required>
        </div>
        <div class="form-group col-md-6">
          <label for="cpf">CPF</label>
          <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF">
        </div>
        <div class="form-group col-md-6">
          <label for="celular">Celular</label>
          <input type="tel" class="form-control" id="celular" name="celular" placeholder="Celular">
        </div>
        <div class="form-group col-md-6">
          <label for="cep">CEP</label>
          <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP">
        </div>
        <div class="form-group col-md-6">
          <label for="endereco">Endereço</label>
          <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço">
        </div>
        <div class="form-group col-md-6">
          <label for="bairro">Bairro</label>
          <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
        </div>
        <div class="form-group col-md-6">
          <label for="uf">Estado</label>
          <input type="text" class="form-control" id="uf" name="uf" placeholder="Estado">
        </div>
      </div>
      <button type="submit" class="btn btn-primary" name="novo_cliente">Cadastrar</button>
    </form>
  </div>

  <?php include_once('footer.php'); ?>

</body>

</html>