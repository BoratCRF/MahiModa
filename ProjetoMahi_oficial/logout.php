<?php
 session_start(); // Inicia a sessão

// Destroi todas as variáveis de sessão
$_SESSION = array();

// Redireciona para a página de login (ou qualquer outra página que desejar)
header("location: index.php");
exit;
?>