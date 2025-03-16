<?php

include('../config.php');
include(DBAPI);

$tablets = null;
$tablet = null;

function index() {
    global $tablets;
    $tablets = find_all('tablets');
}

function add() {
    if (isset($_POST['tablets'])) {
        $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));

        $tablet = $_POST['tablets'];
        $tablet['modified'] = $tablet['created'] = $today->format("Y-m-d H:i:s");

        $uploadOk = 1; // Flag para controle de status de upload
        $target_dir = "images/"; // Diretório onde a imagem será salva

        // Verifica se o arquivo de imagem foi enviado
        if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
            $target_file = $target_dir . basename($_FILES['img']["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Verifica se o arquivo é uma imagem
            $check = getimagesize($_FILES['img']["tmp_name"]);
            if ($check !== false) {
                // O arquivo é uma imagem válida
            } else {
                echo "O arquivo não é uma imagem.";
                $uploadOk = 0;
            }

            // Verifica o tamanho do arquivo (limite de 6MB)
            if ($_FILES['img']["size"] > 6000000) {
                echo "O arquivo é muito grande.";
                $uploadOk = 0;
            }

            // Permite apenas certos formatos de arquivo
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "Apenas arquivos JPG, JPEG, PNG são permitidos.";
                $uploadOk = 0;
            }

            // Verifica se $uploadOk está definido para 0 devido a algum erro
            if ($uploadOk == 0) {
                echo "O upload da imagem falhou.";
            } else {
                // Tenta fazer o upload do arquivo
                if (move_uploaded_file($_FILES['img']["tmp_name"], $target_file)) {
                    $tablet['img'] = basename($_FILES['img']["name"]); // Salva o nome do arquivo
                } else {
                    echo "Tivemos algum erro ao fazer o upload da imagem.";
                }
            }
        } else {
            // Se nenhuma imagem foi enviada, pode optar por não definir $tablet['img']
            // ou definir um valor padrão se necessário
        }

        // Salva os dados no banco de dados
        save('tablets', $tablet);

        // Redireciona para a página principal após salvar
        header('Location: index.php');
        exit(); // Interrompe a execução após o redirecionamento
    }
}

function edit() {
    global $tablet;
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Se o ID estiver definido, buscamos os dados do tablet
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tablet = $_POST['tablets'];
            $tablet['modified'] = date('Y-m-d H:i:s');

            $uploadOk = 1;
            $target_dir = "images/";

            // Verifica se um arquivo de imagem foi enviado
            if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
                $target_file = $target_dir . basename($_FILES['img']['name']);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Verifica se o arquivo é uma imagem real
                $check = getimagesize($_FILES['img']['tmp_name']);
                if ($check !== false) {
                    // O arquivo é uma imagem válida
                } else {
                    echo "O arquivo não é uma imagem.";
                    $uploadOk = 0;
                }

                // Verifica o tamanho do arquivo (6MB de limite)
                if ($_FILES['img']['size'] > 6000000) {
                    echo "O arquivo é muito grande.";
                    $uploadOk = 0;
                }
                // Permite apenas certos formatos de arquivo
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    echo "Apenas arquivos JPG, JPEG, PNG são permitidos.";
                    $uploadOk = 0;
                }

                // Verifica se $uploadOk está definido para 0 devido a algum erro
                if ($uploadOk == 0) {
                    echo "O upload da imagem falhou.";
                } else {
                    // Tenta fazer o upload do arquivo
                    if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                        $tablet['img'] = basename($_FILES['img']['name']); // Atualiza o nome do arquivo
                    } else {
                        echo "Tivemos algum erro ao fazer o upload da imagem.";
                    }
                }
            } else {
                // Se nenhuma nova imagem foi enviada, mantém a imagem existente
                if (isset($_POST['tablets']['img_atual']) && !empty($_POST['tablets']['img_atual'])) {
                    $tablet['img'] = $_POST['tablets']['img_atual']; // Usa a imagem existente
                }
            }

            // Atualiza os dados do tablet no banco de dados
            if (update('tablets', $id, $tablet)) {
                // Redireciona para a página principal
                header('Location: index.php');
                exit(); // Interrompe a execução do script após o redirecionamento
            } else {
                echo "Erro ao atualizar o item de tablet.";
            }
        } else {
            // Se o método não for POST, busca os dados do tablet
            $tablet = find('tablets', $id);

            if (!$tablet) {
                echo "Erro: Tablet não encontrado.";
                return;
            }
        }
    } else {
        header('Location: index.php');
        exit(); // Interrompe a execução do script após o redirecionamento
    }
}

function view($id = null) {
    global $tablet;
    $tablet = find('tablets', $id);
}

function delete($id = null) {
    if ($id) {
        global $tablet;
        $tablet = remove('tablets', $id);

        header('Location: index.php');
        exit(); // Certifique-se de que o script seja interrompido após o redirecionamento
    } else {
        header('Location: index.php');
        exit(); // Certifique-se de que o script seja interrompido após o redirecionamento
    }
}