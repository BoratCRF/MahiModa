<?php
include_once 'config.php';
include_once 'admin.php';
function generateRandomString($length = 10)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
// Função para calcular o valor total da soma dos produtos de mesmo id
function calculateTotalByProductId($carrinho, $id_produto)
{
    global $conn;
    $valor_total = 0;

    foreach ($carrinho as $item) {
        if ($item['id_produto'] == $id_produto) {
            $quantidade = $item['quantidade'];
            $valor_total += $quantidade * $item['preco'];
        }
    }
    return $valor_total;
}

// Função para calcular o valor total do pedido
function calculateTotal($carrinho)
{
    global $conn;
    $total_pedidos = 0;

    foreach ($carrinho as $item) {
        $produto_id = $item['id_produto'];
        $quantidade = $item['quantidade'];

        // Consulta os detalhes do produto no banco de dados
        $query_produto = "SELECT preco_venda FROM produtos WHERE id_produto = ?";
        $stmt_produto = mysqli_prepare($conn, $query_produto);
        mysqli_stmt_bind_param($stmt_produto, "i", $produto_id);
        mysqli_stmt_execute($stmt_produto);
        $result_produto = mysqli_stmt_get_result($stmt_produto);

        // Verifica se o produto foi encontrado
        if ($row = mysqli_fetch_assoc($result_produto)) {
            $produto_preco = $row['preco_venda'];
            $total_pedidos += $produto_preco * $quantidade;
        }
    }

    return $total_pedidos;
}

// Inicia ou resgata a sessão
session_start();

// Define o ID do pedido se ainda não estiver definido
if (!isset($_SESSION['id_pedido'])) {
    $_SESSION['id_pedido'] = uniqid(); // Cria um ID de pedido único
}

// Inclui o arquivo de configuração do banco de dados
include_once 'config.php';

// Verifique se o ID do produto foi fornecido via GET
if (isset($_GET['id_produto'])) {
    // Obtém o ID do produto da URL
    $id_produto = $_GET['id_produto'];

    // Verifique se o produto já está no carrinho
    if (isset($_SESSION['carrinho'][$id_produto])) {
        // Se o produto já estiver no carrinho, verifique se a quantidade está sendo passada via GET
        if (isset($_GET['quantidade']) && is_numeric($_GET['quantidade']) && $_GET['quantidade'] > 0) {
            // Se a quantidade for maior que 0, adicione a quantidade passada à quantidade existente no carrinho
            $_SESSION['carrinho'][$id_produto] += intval($_GET['quantidade']);
        } else {
            // Se nenhuma quantidade for passada ou se for inválida, aumente a quantidade em 1
            $_SESSION['carrinho'][$id_produto]++;
        }
    } else {
        // Se o produto não estiver no carrinho, verifique se a quantidade está sendo passada via GET
        if (isset($_GET['quantidade']) && is_numeric($_GET['quantidade']) && $_GET['quantidade'] > 0) {
            // Se a quantidade for maior que 0, defina a quantidade conforme passada via GET
            $_SESSION['carrinho'][$id_produto] = intval($_GET['quantidade']);
        } else {
            // Se nenhuma quantidade for passada ou se for inválida, defina a quantidade como 1
            $_SESSION['carrinho'][$id_produto] = 1;
        }
    }

    // Redirecione para a página de carrinho
    header('Location: cat_carrinho.php');
    exit;
}

// Ao finalizar o carrinho
if (isset($_POST['finalizar_compra'])) {
    // Verifica se há produtos no carrinho
    if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
        // Define outros detalhes do pedido, como o ID do usuário e a data de criação do pedido
        $id_cliente = $_SESSION['id_cliente']; // Suponha que você tenha o ID do cliente na sessão
        $dt_criacao = date('Y-m-d H:i:s'); // Data atual
        $cod_rastreamento = generateRandomString(12); // Gera um código de rastreamento aleatório
        $total_produtos = count($_SESSION['carrinho']); // Total de produtos no carrinho
        $total_pedido = 0; // Inicializa o total do pedido

        // Crie um novo pedido na tabela "pedidos"
        $query_pedido = "INSERT INTO pedidos (id_cliente, dt_criacao, cod_rastreamento, total_produtos, total_pedido) VALUES (?, ?, ?, ?, ?)";
        $stmt_pedido = mysqli_prepare($conn, $query_pedido);
        mysqli_stmt_bind_param($stmt_pedido, "isssd", $id_cliente, $dt_criacao, $cod_rastreamento, $total_produtos, $total_pedido);
        mysqli_stmt_execute($stmt_pedido);

        // Obtém o ID do pedido recém-inserido
        $id_pedido = mysqli_insert_id($conn);

        // Adicione itens do carrinho à tabela "carrinho" e calcule o total do pedido
        foreach ($_SESSION['carrinho'] as $id_produto => $quantidade) {
            // Consulte o preço do produto no banco de dados
            $query_produto = "SELECT preco_venda FROM produtos WHERE id_produto = ?";
            $stmt_produto = mysqli_prepare($conn, $query_produto);
            mysqli_stmt_bind_param($stmt_produto, "i", $id_produto);
            mysqli_stmt_execute($stmt_produto);
            $result_produto = mysqli_stmt_get_result($stmt_produto);

            // Verifique se o produto foi encontrado e obtenha seu preço
            if ($row = mysqli_fetch_assoc($result_produto)) {
                $produto_preco = $row['preco_venda'];

                // Calcule o valor total do item
                $valor_total = $quantidade * $produto_preco;

                // Insira o item no carrinho
                $query_carrinho = "INSERT INTO carrinho (id_pedido, id_produto, quantidade, preco, valor_total) VALUES (?, ?, ?, ?, ?)";
                $stmt_carrinho = mysqli_prepare($conn, $query_carrinho);
                mysqli_stmt_bind_param($stmt_carrinho, "iiidd", $id_pedido, $id_produto, $quantidade, $produto_preco, $valor_total);
                mysqli_stmt_execute($stmt_carrinho);
                mysqli_stmt_close($stmt_carrinho); // Feche a declaração após cada execução

                // Adicione o preço do produto multiplicado pela quantidade ao total do pedido
                $total_pedido += $produto_preco * $quantidade;
            } else {
                // Lidar com o caso em que o produto não é encontrado ou o preço não está disponível
            }

            // Feche a declaração do produto após cada execução
            mysqli_stmt_close($stmt_produto);
        }

        // Atualize o total do pedido na tabela "pedidos" com o valor calculado
        $query_update_pedido = "UPDATE pedidos SET total_pedido = ? WHERE id_pedido = ?";
        $stmt_update_pedido = mysqli_prepare($conn, $query_update_pedido);
        mysqli_stmt_bind_param($stmt_update_pedido, "di", $total_pedido, $id_pedido);
        mysqli_stmt_execute($stmt_update_pedido);

        // Limpa o carrinho
        unset($_SESSION['carrinho']);

        // Redirecione para a página de confirmação do pedido
        header('Location: cat_carrinho.php?id_pedido=' . $id_pedido);
        exit;
    } else {
        // Se o carrinho estiver vazio, exiba uma mensagem de erro
        echo "Seu carrinho está vazio.";
    }
}

// Verifica se o ID do produto foi fornecido via GET
if(isset($_GET['id_produto']))  {
    // Obtém o ID do produto da URL
    $id_produto = $_GET['id_produto'];

    // Verifica se o produto está no carrinho
    if(isset($_SESSION['carrinho'][$id_produto])) {
        // Reduz a quantidade do produto no carrinho em 1
        $_SESSION['carrinho'][$id_produto]--;
        
        // Se a quantidade chegar a zero, remove o produto do carrinho completamente
        if($_SESSION['carrinho'][$id_produto] <= 0) {
            unset($_SESSION['carrinho'][$id_produto]);
        }

        // Redireciona de volta para a página do carrinho ou para onde você deseja redirecionar
        header('Location: cat_carrinho.php');
        exit;
    } else {
        // Se o produto não estiver no carrinho, exiba uma mensagem de erro ou redirecione para alguma outra página
        echo "O produto selecionado não está no carrinho.";
        // Ou redirecione para a página do carrinho
        // header('Location: cat_carrinho.php');
        // exit;
    }
} else {
    // Se o ID do produto não foi fornecido via GET, exiba uma mensagem de erro ou redirecione para alguma outra página
    echo "ID do produto não especificado.";
    // Ou redirecione para alguma outra página
    // header('Location: alguma_pagina.php');
    // exit;
}

// Limpa o carrinho
unset($_SESSION['carrinho']);

// Redireciona de volta para a página do carrinho ou para onde você deseja redirecionar
header('Location: cat_carrinho.php');
exit;