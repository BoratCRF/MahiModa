<?php
require_once('validarLogin.php');
require_once('header.php');

// Verifica se uma sessão está ativa
if (session_status() == PHP_SESSION_NONE) {
    // Inicia a sessão apenas se não estiver ativa
    session_start();
}

// // Se as variáveis de sessão NÃO estiverem definidas, redireciona para a página de login
// if (!isset($_SESSION['id']) || !isset($_SESSION['email'])) {
//     header("Location: cat_login.php");
//     die();
// }

// Obter o ID do cliente a ser editado
$id_cliente = $_SESSION['id_cliente'];

// Realizar a consulta no banco de dados para obter os dados do cliente com o ID fornecido
$consulta = "SELECT * FROM clientes WHERE id_cliente = $id_cliente";
$resultado = $conn->query($consulta);

// Verificar se a consulta retornou resultados
if ($resultado->num_rows > 0) {
    // Obter os dados do cliente
    $cliente = $resultado->fetch_assoc();
} else {
    // Redirecionar para a página principal se o cliente não for encontrado
    header("Location: cat_produtos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Editar Pefil</title>
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
<header>Editar Perfil</header>
<body>

    <div class="container pt-1 mt-2 text-muted">
        <h4>Editor de Perfil</h4>
    </div>

    <div class="container pt-1 shadow-sm bg-white">
        <div class="row mt-2">
            <div class="form-group col-md-16">
                <form action="usuario_bd.php" method="post" enctype="multipart/form-data">
                    <!-- Adicione um campo hidden para armazenar o ID do cliente -->
                    <input type="hidden" name="id_cliente" value="<?= $cliente['id_cliente'] ?>">

                    <!-- Exibir dados existentes do cliente (exceto id_cliente e senha) -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?= $cliente['nome'] ?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cep">CEP</label>
                            <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" value="<?= $cliente['cep'] ?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="uf">UF</label>
                            <input type="text" class="form-control" id="uf" name="uf" placeholder="uf" value="<?= $cliente['uf'] ?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="endereco">Endereco</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="endereco" value="<?= $cliente['endereco'] ?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="bairro">Bairro</label>
                            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="bairro" value="<?= $cliente['bairro'] ?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="celular">Celular</label>
                            <input type="text" class="form-control" id="celular" name="celular" placeholder="celular" value="<?= $cliente['celular'] ?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dtnascimento">Data de nascimento</label>
                            <input type="text" class="form-control" id="dtnascimento" name="dtnascimento" placeholder="dtnascimento" value="<?= $cliente['dtnascimento'] ?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?= $cliente['email'] ?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" value="<?= $cliente['cpf'] ?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="senha">Nova Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Nova Senha">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirmar_senha">Confirmar Nova Senha</label>
                            <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" placeholder="Confirmar Nova Senha">
                        </div>

                        <!-- Adicione outros campos conforme necessário -->

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary" name="edit_perfil">Salvar</button>
                            <a href="cat_perfil.php" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Adicione scripts conforme necessário (Bootstrap, etc.) -->

</body>
<?php include_once('footer.php'); ?>
</html>
