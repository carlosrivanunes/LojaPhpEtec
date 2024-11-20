<?php

include('../config.php');
include(DBAPI);

$clothes = null;
$cloth = null;

function index() {
    global $clothes;
    $clothes = find_all('clothes');
}

function add() {
    if (isset($_POST['clothes'])) {
        $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));

        $cloth = $_POST['clothes'];
        $cloth['modified'] = $cloth['created'] = $today->format("Y-m-d H:i:s");

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
                    $cloth['img'] = basename($_FILES['img']["name"]); // Salva o nome do arquivo
                } else {
                    echo "Tivemos algum erro ao fazer o upload da imagem.";
                }
            }
        } else {
            // Se nenhuma imagem foi enviada, pode optar por não definir $cloth['img']
            // ou definir um valor padrão se necessário
        }

        // Salva os dados no banco de dados
        save('clothes', $cloth);

        // Redireciona para a página principal após salvar
        header('Location: index.php');
        exit(); // Interrompe a execução após o redirecionamento
    }
}

function edit() {
    global $cloth;
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Se o ID estiver definido, buscamos os dados da roupa
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cloth = $_POST['clothes'];
            $cloth['modified'] = date('Y-m-d H:i:s');

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
                        $cloth['img'] = basename($_FILES['img']['name']); // Atualiza o nome do arquivo
                    } else {
                        echo "Tivemos algum erro ao fazer o upload da imagem.";
                    }
                }
            } else {
                // Se nenhuma nova imagem foi enviada, mantém a imagem existente
                if (isset($_POST['clothes']['img_atual']) && !empty($_POST['clothes']['img_atual'])) {
                    $cloth['img'] = $_POST['clothes']['img_atual']; // Usa a imagem existente
                }
            }

            // Atualiza os dados da roupa no banco de dados
            if (update('clothes', $id, $cloth)) {
                // Redireciona para a página principal
                header('Location: index.php');
                exit(); // Interrompe a execução do script após o redirecionamento
            } else {
                echo "Erro ao atualizar o item de roupa.";
            }
        } else {
            // Se o método não for POST, busca os dados da roupa
            $cloth = find('clothes', $id);

            if (!$cloth) {
                echo "Erro: Roupa não encontrada.";
                return;
            }
        }
    } else {
        header('Location: index.php');
        exit(); // Interrompe a execução do script após o redirecionamento
    }
}

function view($id = null) {
    global $cloth;
    $cloth = find('clothes', $id);
}

function delete($id = null) {
    if ($id) {
        global $cloth;
        $cloth = remove('clothes', $id);

        header('Location: index.php');
        exit(); // Certifique-se de que o script seja interrompido após o redirecionamento
    } else {
        header('Location: index.php');
        exit(); // Certifique-se de que o script seja interrompido após o redirecionamento
    }
}