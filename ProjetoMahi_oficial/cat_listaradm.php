<?php
// Função para obter a função do usuário (você pode personalizar isso conforme necessário)
function getFuncaoNome($funcao) {
    switch ($funcao) {
        case 1:
            return 'Gerente';
        case 2:
            return 'Administrador';
        default:
            return 'Desconhecido';
    }
    return $funcao;
}

// Função para formatar a data (você pode personalizar isso conforme necessário)
function formatarData($data) {
    // Lógica para formatar a data conforme necessário
    $dataFormatada = date("d/m/Y", strtotime($data));
    return $dataFormatada;
    }

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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Listar Administradores</title>
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

<header>Administradores</header>

<body>
    <h2>Bem-vindo à lista de Administradores</h2>
    <a href="cat_novoadm.php"><i class="bi bi-plus-circle"></i> Adicionar novo Administrador</a>
    <!-- Lista de Produtos Existente -->
    <h3>Gerentes e Administradores</h3>
    <form method="post" action="admin.php" onsubmit="return confirmarExclusao()">
    <table class="table table-striped shadow-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Função</th>
                <th>Telefone</th>
                <th>Data de Cadastro</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= $usuario['nome'] ?></td>
                    <td><?= $usuario['email'] ?></td>
                    <td><?= getFuncaoNome($usuario['funcao']) ?></td>
                    <td><?= $usuario['telefone'] ?></td>
                    <td><?= formatarData($usuario['dtcadastro']) ?></td>
                    <td>
                        <input type="checkbox" name="excluir[]" value="<?= $usuario['id'] ?>">
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <br>
    <button type="submit">Excluir Usuários Selecionados</button>
    <script>
function confirmarExclusao() {
    return confirm("Tem certeza de que deseja excluir os usuários selecionados?");
}
</script>
</form>
</body>
<?php include_once('footer.php'); ?>
</body>
