<?php
// Inicia ou resgata a sessão
if (session_status() == PHP_SESSION_NONE) {
    // Inicia a sessão apenas se não estiver ativa
    session_start();
}

// Verifica se o ID do produto foi fornecido via GET
if (isset($_GET['id_produto'])) {
    // Obtém o ID do produto da URL
    $id_produto = $_GET['id_produto'];

    // Verifica se o produto está no carrinho
    if (isset($_SESSION['carrinho']) && isset($_SESSION['carrinho'][$id_produto])) {
        // Reduz a quantidade do produto no carrinho em 1
        $_SESSION['carrinho'][$id_produto]--;

        // Se a quantidade chegar a zero ou menos, remove completamente o produto do carrinho
        if ($_SESSION['carrinho'][$id_produto] <= 0) {
            unset($_SESSION['carrinho'][$id_produto]);
        }

        // Redireciona de volta para a página do carrinho
        header('Location: cat_carrinho.php');
        exit;
    } else {
        // Se o produto não estiver no carrinho, exibe uma mensagem de erro
        echo "O produto selecionado não está no carrinho.";
    }
} else {
    // Se o ID do produto não foi fornecido via GET, exibe uma mensagem de erro
    echo "ID do produto não especificado.";
}
