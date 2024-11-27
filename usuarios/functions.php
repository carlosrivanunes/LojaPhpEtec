<?php

ini_set('display_errors', 1);   // Habilita a exibição de erros
error_reporting(E_ALL);

include('../config.php');
include(DBAPI);

$usuarios = null;
$usuario = null;

/**
 * Listagem de Usuários
 */
function index()
{
	global $usuarios;
	if (!empty($_POST['users'])) {
		$usuarios = filter("usuarios", "nome like '%" . $_POST['users'] . "%'");
	} else {
		$usuarios = find_all("usuarios");
	}
}

/**
 *  Upload de imagens
 */
function upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo)
{
	try {
		$nomearquivo = basename($arquivo_destino);
		$uploadOk = 1;
		if (!isset($_POST['submit'])) {
			$check = getimagesize($nome_temp);
			if ($check !== false) {
				$_SESSION['message'] = "File is an image - " . $check['mime'] . ".";
				$_SESSION['type'] = "info";
				$uploadOk = 1;
			} else {
				$uploadOk = 0;
				throw new Exception("O arquivo não é uma imagem!");
			}
		}

		if (file_exists($arquivo_destino)) {
			$uploadOk = 0;
			throw new Exception("Desculpe, o arquivo já existe!");
		}

		if ($tamanho_arquivo > 5000000) {
			$uploadOk = 0;
			throw new Exception("Desculpe, mas o arquivo é muito grande!");
		}

		if ($tipo_arquivo != "jpg" && $tipo_arquivo != "png" && $tipo_arquivo != "jpeg" && $tipo_arquivo != "gif") {
			$uploadOk = 0;
			throw new Exception("Desculpe, mas nó são permitidos arquivos de imagem JPG, JPEG, PNG E GIF!");
		}

		if ($uploadOk == 0) {
			throw new Exception("Desculpe, mas o arquivo não pode ser enviado.");
		} else {
			if (move_uploaded_file($_FILES['foto']['tmp_name'], $arquivo_destino)) {
				$_SESSION['message'] = "O arquivo " . htmlspecialchars($nomearquivo) . "foi armazenado.";
				$_SESSION['type'] = "success";
			} else {
				throw new Exception("Desculpe, mas o aarquivo não pode ser enviado.");
			}
		}
	} catch (Exception $e) {
		$_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
		$_SESSION['type'] = "danger";
	}
}

/**
 * Cadastro Usuários
 */
function add()
{
	if (!empty($_POST['usuario'])) {
		try {
			$usuario = $_POST['usuario'];
			
			// Verificar se o usuário enviou uma foto
			if (!empty($_FILES["foto"]["name"])) {
				// Configurações de upload da foto
				$pasta_destino = "fotos/";
				$tipo_arquivo = strtolower(pathinfo(basename($_FILES["foto"]["name"]), PATHINFO_EXTENSION));
				$nomearquivo = uniqid() . "." . $tipo_arquivo;  // Gerar um nome único para a imagem
				$arquivo_destino = $pasta_destino . $nomearquivo;
				$tamanho_arquivo = $_FILES["foto"]["size"]; // Tamanho do arquivo
				$nome_temp = $_FILES["foto"]["tmp_name"];   // Nome temporário do arquivo no servidor

				// Função de upload para mover a imagem para a pasta destino
				upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);

				// Atribui o nome do arquivo ao campo 'foto' do usuário
				$usuario['foto'] = $nomearquivo;
			} else {
				// Caso não tenha foto, atribui uma imagem padrão
				$usuario['foto'] = 'semimagem.jpg';
			}

			// Criptografar a senha se ela for informada
			if (!empty($usuario['pass'])) {
				$senha = criptografia($usuario['pass']);
				$usuario['pass'] = $senha;
			}

			// Salva o usuário no banco de dados
			save('usuarios', $usuario);

			// Redireciona para a página inicial após o cadastro
			header('Location: index.php');
			exit();  // Garantir que o script pare de ser executado após o redirecionamento
		} catch (Exception $e) {
			// Mensagem de erro
			$_SESSION['message'] = 'Aconteceu um erro: ' . $e->getMessage();
			$_SESSION['type'] = 'danger';
		}
	}
}

/**
 * Atualização/Edição de Usuários
 */
function edit()
{
	try {
		if (isset($_GET['id'])) {

			$id = $_GET['id'];

			if (isset($_POST['usuario'])) {
				$usuario = $_POST['usuario'];

				//criptografando a senha
				if (!empty($usuario['pass'])) {
					$senha = criptografia($usuario['pass']);
					$usuario['pass'] = $senha;
				}

				if (!empty($_FILES['foto']['name'])) {
					//Upload da foto
					$pasta_destino = "fotos/";
					$arquivo_destino = $pasta_destino . basename($_FILES['foto']['name']);
					$nomearquivo = basename($_FILES['foto']['name']);
					$resolução_arquivo = getimagesize($_FILES['foto']['tmp_name']);
					$tamanho_arquivo = $_FILES['foto']['size'];
					$nome_temp = $_FILES['foto']['tmp_name'];
					$tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));

					/*
					$arr = get_defined_vars();
					var_dump($arr);	
					*/
					upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);

					$usuario['foto'] = $nomearquivo;
				}

				update('usuarios', $id, $usuario);
				//header('Location: index.php');
			} else {
				global $usuario;
				$usuario = find("usuarios", $id);
			}
		} else {
			header("Location: index.php");
		}
	} catch (Exception $e) {
		$_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
		$_SESSION['type'] = "danger";
	}
}
/**
 * Visualização de um Usuário 
 */
function view($id = null)
{
	global $usuario;
	$usuario = find("usuarios", $id);
}

/**
 * Exclusão de um Usuario
 */
function delete($id = null)
{
	try {
		if (!empty($id)) {
			// Buscar o usuário antes de deletar para remover a foto se existir
			$usuario = find("usuarios", $id);

			// Verifica se o usuário existe
			if ($usuario) {
				// Se o usuário tiver uma foto (diferente da imagem padrão), ela será deletada
				if (isset($usuario['foto']) && $usuario['foto'] != 'semimagem.jpg') {
					$arquivo_foto = "fotos/" . $usuario['foto'];

					// Verifica se o arquivo existe no servidor antes de tentar deletar
					if (file_exists($arquivo_foto)) {
						unlink($arquivo_foto);  // Deleta a foto do servidor
					}
				}

				// Remover o usuário do banco de dados
				remove("usuarios", $id);

				// Mensagem de sucesso
				$_SESSION['message'] = "Usuário deletado com sucesso.";
				$_SESSION['type'] = "success";
			} else {
				throw new Exception("Usuário não encontrado.");
			}
		} else {
			throw new Exception("ID inválido.");
		}
	} catch (Exception $e) {
		// Mensagem de erro
		$_SESSION['message'] = "Erro ao deletar o usuário: " . $e->getMessage();
		$_SESSION['type'] = "danger";
	}

	// Redirecionar para a página inicial
	header("Location: index.php");
	exit();
}
