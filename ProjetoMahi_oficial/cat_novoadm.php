<?php

function getCategoriaNome($funcao)
{
    switch ($funcao) {
        case 1:
            return 'Gerente';
        case 2:
            return 'Administrador';
        default:
            return 'Desconhecido';
    }
}

// Inclua a conexão com o banco de dados a partir do seu arquivo config.php
require_once('validarLogin.php');
require_once('header.php');
require_once('admin.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Administrador</title>
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
<header>Novo Administrador</header>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <table class="table table-striped table-hover">
                <h1 class="tab-title text-center">Adicionar Administrador</h1>
            </table>
            <form action="admin.php" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="telefone">Telefone</label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="(dd) 99999-9999" pattern="\([0-9]{2}\) [0-9]{5}-[0-9]{4)"required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="funcao">Função:</label>
                        <select class="form-control" id="funcao" name="funcao" required>>
                            <option value="1">Gerente</option>
                            <option value="2">Administrador</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dtcadastro">Data de Cadastro</label>
                        <input type="date" class="form-control" id="dtcadastro" name="dtcadastro" required>
                    </div>
                    <div class="form-group col-md-8">
                        <button type="submit" class="btn btn-primary" name="add_admin">Cadastrar</button>
                    </div>
                </div>
        </div>
    </div>

    <!-- Adicione os scripts do Bootstrap (jQuery e Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <!-- Adicione o script do Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<?php include_once('footer.php'); ?>
</html>