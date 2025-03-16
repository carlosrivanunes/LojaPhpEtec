<?php
// Iniciar buffer de saída para evitar problemas com headers já enviados
ob_start();

include("../config.php");
include(DBAPI);
include(HEADER_TEMPLATE);

// Iniciar sessão antes de qualquer outra coisa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar se login e senha foram enviados
if (empty($_POST['login']) || empty($_POST['senha'])) {
    header("Location: " . BASEURL . "index.php");
    exit;
}

$bd = open_database();

try {
    // Preparar dados
    $usuario = $_POST['login'];
    $senha = criptografia($_POST['senha']);
    //$senha = ($_POST['senha']);
    // Usar prepared statements para evitar SQL Injection
    $stmt = $bd->prepare("SELECT id, nome, user, pass FROM usuarios WHERE user = ? AND pass = ? LIMIT 1");
    $stmt->bind_param('ss', $usuario, $senha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Dados do usuário
        $dados = $resultado->fetch_assoc();
        $_SESSION['id'] = $dados['id'];
        $_SESSION['nome'] = $dados['nome'];
        $_SESSION['user'] = $dados['user'];

        // Mensagem de boas-vindas
        $_SESSION['message'] = "Bem-vindo, " . $dados['nome'] . "!";
        $_SESSION['type'] = "success";

        header("Location: " . BASEURL . "index.php");
        exit;
    } else {
        // Credenciais incorretas
        $_SESSION['message'] = "Usuário ou senha incorretos.";
        $_SESSION['type'] = "danger";
        header("Location: " . BASEURL . "inc/login.php");
        exit;
    }
} catch (Exception $e) {
    // Tratamento de erro
    $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
    $_SESSION['type'] = "danger";
    header("Location: " . BASEURL . "inc/login.php");
    exit;
}

// Limpar buffer de saída e enviar conteúdo
ob_end_flush();
?>
