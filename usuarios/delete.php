<?php
include("functions.php");

if (isset($_GET['id'])) {
    try {
        // Consultando o usuário para obter o nome do arquivo da foto
        $user = find("usuarios", $_GET['id']);

        // Chamando a função delete para apagar o usuário do banco de dados
        delete($_GET['id']);

        // Apagando o arquivo da foto do usuário da pasta fotos
        if (!empty($user['foto']) && $user['foto'] != 'semimagem.jpg') {
            unlink("fotos/" . $user['foto']);
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Não foi possível realizar a operação: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
    header("Location: index.php");
}
