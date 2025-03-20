<?php

// Função para evitar injeção de SQL
function validarEntrada($entrada)
{
    global $conn; // Torna a variável $conn global dentro da função
    $entrada = trim($entrada);
    $entrada = stripslashes($entrada);
    $entrada = htmlspecialchars($entrada);
    return $entrada;
}

// Verificação do formulário de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = validarEntrada($_POST["email"]);
    $senha = validarEntrada($_POST["senha"]);

    // // Validação do formulário
    // if (empty($email) || empty($senha)) {
    //     echo "Preencha todos os campos.";
    //     exit();
    // }

    // Sua conexão com o banco de dados
    $conn = new mysqli("localhost", "root", "", "mahimodabd");

    // Verifica se a conexão foi estabelecida com sucesso
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Consulta SQL para verificar o login usando prepared statement
    $stmt = $conn->prepare("SELECT id_cliente, email, senha FROM clientes WHERE email = ?");

    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id_cliente, $email, $senhaArmazenadaNoBanco);

    if ($stmt->fetch()) {
        // Usuário encontrado, verifica a senha
        if (password_verify($senha, $senhaArmazenadaNoBanco)) {
            // Senha correta, o login é válido

            // Inicia a sessão e armazena informações do usuário
            session_start();
            $_SESSION["id_cliente"] = $id_cliente;
            $_SESSION["email"] = $email;
            echo "Login bem-sucedido! ID do usuário: " . $id_cliente;
            header("Location: index.php");
            exit();
        } else {
            // Senha incorreta
            echo "Credenciais inválidas. Senha incorreta. ";
        }
    } else {
        // Usuário não encontrado
        echo "Credenciais inválidas. Usuário não encontrado. ";
    }

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = validarEntrada($_POST["email"]);
    $senha = validarEntrada($_POST["senha"]);

    // Sua conexão com o banco de dados
    $conn = new mysqli("localhost", "root", "", "mahimodabd");

    // Verifica se a conexão foi estabelecida com sucesso
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Consulta SQL para verificar o login usando prepared statement
    $stmt = $conn->prepare("SELECT id, email, senha FROM usuarios WHERE email = ?");

    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $email, $senhaArmazenadaNoBanco);

    if ($stmt->fetch()) {
        // Usuário encontrado, verifica a senha
        if (password_verify($senha, $senhaArmazenadaNoBanco)) {
            // Senha correta, o login é válido

            // Inicia a sessão e armazena informações do usuário
            session_start();
            $_SESSION["id"] = $id;
            $_SESSION["email"] = $email;
            echo "Login bem-sucedido! ID do usuário: " . $id;
            header("Location: index.php");
            exit();
        } else {
            // Senha incorreta
            echo "Senha incorreta ";
        }
    } else {
        // Usuário não encontrado
        echo "Usuário não encontrado";
    }

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
        

?>
