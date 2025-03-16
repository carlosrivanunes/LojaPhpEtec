<?php
session_start();
include('functions.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Chame a função de exclusão
    delete($id);
} else {
    // Defina a mensagem de erro
    $_SESSION['message'] = "Erro ao tentar excluir o registro.";
    $_SESSION['type'] = "danger";
}

header('Location: index.php');
exit();
