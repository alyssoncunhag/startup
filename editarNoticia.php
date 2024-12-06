<?php
session_start();
include 'classes/noticias.class.php';
include 'classes/usuarios.class.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

// Instancia as classes
$noticia = new Noticias();
$usuarios = new Usuarios();
$usuarios->setUsuario($_SESSION['logado']);

// Verifica se existe um ID na URL para editar uma notícia
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $noticiaInfo = $noticia->buscar($id); // Verifica se a consulta retorna o índice correto
    if (!$noticiaInfo) {
        // Caso não encontre a notícia
        echo "Notícia não encontrada.";
        exit;
    }
}

// Verifica se 'conteudo' existe na array antes de usá-la
$conteudo = isset($noticiaInfo['conteudo']) ? $noticiaInfo['conteudo'] : ''; // Define valor default caso não exista

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $categoria = $_POST['categoria'];
    $conteudo = $_POST['conteudo'];  // Conteúdo da notícia
    $data_publicacao = $_POST['data_publicacao'];
    $imagem = $_FILES['imagem'];
    $excluirImagem = isset($_POST['excluir_imagem']) ? true : false;

    if ($excluirImagem) {
        $imagemPath = 'img/noticias/' . $noticiaInfo['imagem'];
        if (file_exists($imagemPath)) {
            unlink($imagemPath); 
        }
        $imagemNome = null; // Não irá salvar nada no banco para a imagem
    } else {
        // Caso contrário, faz o upload de uma nova imagem se o usuário enviou uma
        if (!empty($imagem['name'])) {
            // Gerar nome único para a imagem
            $imagemNome = md5(time() . rand(0, 9999)) . '.jpg';
            $imagemPath = 'img/noticias/' . $imagemNome;

            // Tente mover a imagem para o diretório correto
            if (move_uploaded_file($imagem['tmp_name'], $imagemPath)) {
                // Se o arquivo foi carregado corretamente, o nome da imagem será usado no banco
            } else {
                // Caso contrário, continue sem atualizar a imagem
                $imagemNome = $noticiaInfo['imagem']; // Manter a imagem anterior se o upload falhar
            }
        } else {
            // Caso não tenha enviado uma nova imagem, mantém a imagem atual
            $imagemNome = $noticiaInfo['imagem']; // Manter a imagem atual
        }
    }

    // Atualiza os dados da notícia, incluindo a imagem
    $noticia->editar($titulo, $autor, $categoria, $conteudo, $data_publicacao, $imagemNome, $id);

    // Redireciona para a página inicial após a edição
    header("Location: indexNoticias.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Notícia</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/editarNoticia.css">
</head>
<body>
    <div class="container">
        <h1>Editar Notícia</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $noticiaInfo['id']; ?>">

            <!-- Título -->
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($noticiaInfo['titulo']); ?>" required>
            </div>

            <!-- Autor -->
            <div class="form-group">
                <label for="autor">Autor:</label>
                <input type="text" class="form-control" id="autor" name="autor" value="<?php echo htmlspecialchars($noticiaInfo['autor']); ?>" required>
            </div>

            <!-- Categoria -->
            <div class="form-group">
                <label for="categoria">Categoria:</label>
                <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo htmlspecialchars($noticiaInfo['categoria']); ?>" required>
            </div>

            <!-- Conteúdo -->
            <div class="form-group">
                <label for="conteudo">Conteúdo:</label>
                <textarea class="form-control" id="conteudo" name="conteudo" required><?php echo htmlspecialchars($conteudo); ?></textarea>
            </div>

            <!-- Data de Publicação -->
            <div class="form-group">
                <label for="data_publicacao">Data de Publicação:</label>
                <input type="date" class="form-control" id="data_publicacao" name="data_publicacao" value="<?php echo htmlspecialchars($noticiaInfo['data_publicacao']); ?>" required>
            </div>

            <!-- Imagem -->
            <div class="form-group">
                <label for="imagem">Imagem:</label>
                <input type="file" class="form-control" id="imagem" name="imagem">
                
                    <img src="img/noticias/<?php echo $noticiaInfo['imagem']; ?>" alt="Imagem atual" width="100"><br>
                
                
                <div class="form-check">
                    <label class="form-check-label" for="excluir_imagem">
                        Excluir imagem atual
                    </label>
                    <input type="checkbox" class="form-check-input" name="excluir_imagem" value="1" id="excluir_imagem">
                </div>
            </div>

            <!-- Botão de submit -->
            <button type="submit" class="btn btn-custom">Salvar</button>
        </form>
    </div>
</body>
</html>
