<?php

require_once 'config.php';

// Função para escapar caracteres especiais para evitar SQL injection
function escape($value) {
    global $conn;
    return mysqli_real_escape_string($conn, $value);
}

// Função para obter todos os produtos do banco de dados
function getAllusuarios($conn)
{
    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);

    $usuarios = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
    }

    return $usuarios;
}
function getAllprodutos($conn)
{
    $sql = "SELECT * FROM produtos";
    $result = $conn->query($sql);

    $produtos = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $produtos[] = $row;
        }
    }

    return $produtos;
}
function getAllCategorias($conn)
{
    $sql = "SELECT * FROM categorias";
    $result = $conn->query($sql);

    $categorias = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categorias[] = $row;
        }
    }

    return $categorias;
}

// Adicionando um novo produto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_produto'])) {
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $preco_custo = $conn->real_escape_string($_POST['preco_custo']);
    $preco_venda = $conn->real_escape_string($_POST['preco_venda']);
    $categoria = $conn->real_escape_string($_POST['categoria']);
    $estoque = $conn->real_escape_string($_POST['estoque']);
    $detalhes = $conn->real_escape_string($_POST['detalhes']);
    
    // Manipulação da imagem
    $nome_imagem = $_FILES['imagem']['name'];
    $caminho_imagem = "img/" . $nome_imagem;

    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_imagem)) {
        // Imagem foi carregada com sucesso
    } else {
        // Houve um problema ao carregar a imagem
        echo "Erro ao carregar a imagem. Verifique as permissões do diretório e o tamanho máximo de upload.";
    }

    // Verifica se o arquivo é uma imagem
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $uploadedExtension = strtolower(pathinfo($nome_imagem, PATHINFO_EXTENSION));

    if (!in_array($uploadedExtension, $allowedExtensions)) {
        echo "Apenas arquivos de imagem são permitidos (jpg, jpeg, png, gif).";
        exit();
    }

    // Inserir no banco de dados
    $sql = "INSERT INTO produtos (descricao, preco_custo, preco_venda, estoque, categoria, detalhes, imagem) 
            VALUES ('$descricao', '$preco_custo', '$preco_venda', '$estoque', '$categoria', '$detalhes', '$caminho_imagem')";
    if ($conn->query($sql) === TRUE) {
        // Produto adicionado com sucesso
        header("Location: cat_produtos.php?mensagem=Produto+adicionado+com+sucesso");
        exit();
    } else {
        echo "Erro na inserção: " . $conn->error;
        header("Location: cat_produtos.php?mensagem=Produto+não+encontrado");
        exit();
    }
}

// Editando um produto existente
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_produto'])) {
    $id_produto = $conn->real_escape_string($_POST['id_produto']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $preco_custo = $conn->real_escape_string($_POST['preco_custo']);
    $preco_venda = $conn->real_escape_string($_POST['preco_venda']);
    $categoria = $conn->real_escape_string($_POST['categoria']);
    $estoque = $conn->real_escape_string($_POST['estoque']);
    $detalhes = $conn->real_escape_string($_POST['detalhes']);
    

    // Verifica se um novo arquivo foi enviado
    if (!empty($_FILES['imagem']['name'])) {
        $nome_imagem = $_FILES['imagem']['name'];
        $caminho_imagem_temp = "img/" . $nome_imagem;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_imagem_temp)) {
            // Imagem foi carregada com sucesso
            $caminho_imagem = $caminho_imagem_temp;

            // Verifica se o arquivo é uma imagem
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $uploadedExtension = strtolower(pathinfo($nome_imagem, PATHINFO_EXTENSION));

            if (!in_array($uploadedExtension, $allowedExtensions)) {
                // Exibe mensagem de erro se o arquivo não for uma imagem
                echo "Apenas arquivos de imagem são permitidos (jpg, jpeg, png, gif).";
                exit();
            }
        } else {
            // Houve um problema ao carregar a imagem
            echo "Erro ao carregar a imagem. Verifique as permissões do diretório e o tamanho máximo de upload.";
            exit();
        }
    } else {
        // Se nenhum novo arquivo foi enviado, mantém o caminho da imagem existente ou padrão
        $caminho_imagem = isset($_POST['foto_preview']) ? $_POST['foto_preview'] : (isset($produtos['imagem']) ? $produtos['imagem'] : 'img/userpadrao.png');
    }
    
    // Atualizar no banco de dados
    $sql = "UPDATE produtos 
            SET descricao='$descricao', preco_custo='$preco_custo', preco_venda='$preco_venda', 
                categoria='$categoria', estoque='$estoque', detalhes='$detalhes', imagem='$caminho_imagem' 
            WHERE id_produto='$id_produto'";
    
    if ($conn->query($sql) === TRUE) {
        // Produto atualizado com sucesso
        header("Location: cat_produtos.php?mensagem=Produto+atualizado+com+sucesso");
        exit();
    } else {
        echo "Erro na atualização: " . $conn->error;
        header("Location: cat_produtos.php?mensagem=Produto+não+encontrado");
        exit();
    }
} elseif (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['id_produto'])) {
    $id_produto = $_GET['id_produto'];

    // Implementa a lógica para excluir produto
    $sql = "DELETE FROM produtos WHERE id_produto = $id_produto";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        // Produto apagado com sucesso
        header("Location: cat_produtos.php?mensagem=Produto+excluido+com+sucesso");
        exit();
    } else {
        // Produto não encontrado ou erro na exclusão
        echo "Erro ao excluir produto: " . $conn->error;
        exit();
    }
}

        // Verifica se o formulário foi submetido
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_admin'])) {
            // Recebe os dados do formulário
            $nome = $_POST["nome"];
            $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT); // Hash para a senha
            $email = $_POST["email"];
            $funcao = $_POST["funcao"];
            $telefone = $_POST["telefone"];
            $dtcadastro = date("Y-m-d H:i:s"); // Adiciona a data de cadastro

            // Insere os dados no banco de dados
            $sql = "INSERT INTO usuarios (nome, senha, email, funcao, telefone, dtcadastro) 
                    VALUES ('$nome', '$senha', '$email', '$funcao', '$telefone', '$dtcadastro')";

            if ($conn->query($sql) === TRUE) {
                echo "Administrador adicionado com sucesso!";
            } else {
                echo "Erro ao adicionar administrador: " . $conn->error;
            }
        }

// Consulta para obter todos os usuários da tabela "usuario"
$sql = "SELECT id, nome, email, funcao, telefone, dtcadastro FROM usuarios";
$result = $conn->query($sql);

$usuarios = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

// Processar a exclusão de usuários
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['excluir'])) {
    $usuariosParaExcluir = $_POST['excluir'];

    foreach ($usuariosParaExcluir as $idUsuario) {
        $idUsuario = escape($idUsuario);
    
        $sqlExclusao = "DELETE FROM usuarios WHERE id = '$idUsuario'";
        
        if ($conn->query($sqlExclusao) === TRUE) {
            // Lógica de exclusão bem-sucedida
            echo "Usuário com ID $idUsuario excluído com sucesso.";
            header("Location: cat_listaradm.php");
            exit();
        } else {
            // Erro na exclusão
            // echo "Erro ao excluir usuário com ID $idUsuario: " . $conn->error;
        }
    }
}
// Obtendo todos os produtos
$produtos = getAllprodutos($conn);
$categorias = getAllCategorias($conn);

// Fechar a conexão com o banco de dados
// $conn->close();
