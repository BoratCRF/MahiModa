<?php

// Inclui o arquivo de conexão com o BD
require_once('config.php');



// // Verifica se o formulário foi enviado
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Código para cadastrar ou editar usuários... 

//     // Recebe os dados do formulário
//     $id_cliente = isset($_POST["id_cliente"]) ? $_POST["id_cliente"] : null;
//     $nome = $_POST["nome"];
//     $email = $_POST["email"];
//     $senha = $_POST["senha"];
//     $dtnascimento = $_POST["dtnascimento"];
//     $cpf = $_POST["cpf"];
//     $celular = $_POST["celular"];
//     $cep = $_POST["cep"];
//     $endereco = $_POST["endereco"];
//     $bairro = $_POST["bairro"];
//     $uf = $_POST["uf"];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_perfil'])) {
    // Recebe os dados do formulário
    $id_cliente = isset($_POST["id_cliente"]) ? $_POST["id_cliente"] : null;
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $dtnascimento = $_POST["dtnascimento"];
    $cpf = $_POST["cpf"];
    $celular = $_POST["celular"];
    $cep = $_POST["cep"];
    $endereco = $_POST["endereco"];
    $bairro = $_POST["bairro"];
    $uf = $_POST["uf"];

    // Editar usuário existente
    $sql = "UPDATE clientes SET ";
    $sql .= " nome = '" . $nome . "', ";
    $sql .= " email = '" . $email . "', ";
    $sql .= " senha = '" . $senha = password_hash($senha, PASSWORD_DEFAULT) . "', ";
    $sql .= " dtnascimento = '" . $dtnascimento . "', ";
    $sql .= " cpf = '" . $cpf . "', ";
    $sql .= " celular = '" . $celular . "', ";
    $sql .= " cep = '" . $cep . "', ";
    $sql .= " endereco = '" . $endereco . "', ";
    $sql .= " bairro = '" . $bairro . "', ";
    $sql .= " uf = '" . $uf . "' ";
    $sql .= " WHERE id_cliente =" . $id_cliente;


    $res = $conn->query($sql);
    // var_dump($_POST);

    if ($res) {
        // Usuário atualizado com sucesso
        header("Location: cat_perfil.php?mensagem=Usuario+atualizado+com+sucesso");
        exit();
    } else {
        header("Location: cat_perfil.php?mensagem=Usuario+atualizado+com+sucesso");
        exit();
        // Falha na atualização, exibe mensagem de erro SQL
        // echo "Erro SQL: " . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['novo_cliente'])) {
        // Recebe os dados do formulário
        $id_cliente = isset($_POST["id_cliente"]) ? $_POST["id_cliente"] : null;
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $dtnascimento = $_POST["dtnascimento"];
        $cpf = $_POST["cpf"];
        $celular = $_POST["celular"];
        $cep = $_POST["cep"];
        $endereco = $_POST["endereco"];
        $bairro = $_POST["bairro"];
        $uf = $_POST["uf"];

    // Adicionar novo usuário
    $sql = "INSERT INTO clientes (nome, email, senha, dtnascimento, cpf, celular, cep, endereco, bairro, uf) ";
    $sql .= " VALUES ( ";
    $sql .= " '" . $nome . "', ";
    $sql .= " '" . $email . "', ";
    $sql .= " '" . $senha = password_hash($senha, PASSWORD_DEFAULT) . "', ";
    $sql .= " '" . $dtnascimento . "', ";
    $sql .= " '" . $cpf . "', ";
    $sql .= " '" . $celular . "', ";
    $sql .= " '" . $cep . "', ";
    $sql .= " '" . $endereco . "', ";
    $sql .= " '" . $bairro . "', ";
    $sql .= " '" . $uf . "') ";
    //  $sql .=") WHERE id =" . $id_cliente;


    $res = $conn->query($sql);
    if ($res == true) {
            // Usuário apagado
        header("Location: cat_login.php?mensagem=Cliente+cadastrado+com+sucesso");
        exit();
    } else {
        // Usuário não encontrado
        header("Location: cat_cadastro.php?mensagem=Cliente+não+cadastrado");
        exit();
    }

} 
  
    

// if (isset($_GET['acao']) && isset($_GET['id'])) {
 
    
//      $acao = $_GET['acao'];
//      $id_cliente = $_GET['id'];
 
//      // Verifica a ação desejada
//      switch ($acao) {
//          case 'excluir':
//              // Implementa a lógica para excluir usuário
//             $sql = "DELETE FROM clientes WHERE id =" . $id_cliente;
//             $res = $conn->query($sql);

//             var_dump($sql);

//             if ($res == true) {
//                  // Usuário apagado
//                 // header("Location: index.php?mensagem=Usuario+excluido+com+sucesso");
//                 exit();
//             } else {
//                 // Usuário não encontrado
//                 // header("Location: index.php?mensagem=Usuario+não+encontrado");
//                 exit();
//             }
             
//         default:
//             // Ação desconhecida
//             // header("Location: index.php?mensagem=Acao+desconhecida");
//             exit();
//     }

// } else {
//     // Ação padrão quando nenhum parâmetro é fornecido
//     // header("Location: index.php");
//     exit();
// }

?>
