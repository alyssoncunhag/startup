<?php
session_start();
include 'classes/noticias.class.php';
include 'classes/usuarios.class.php';

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

$noticia = new Noticias();
$usuarios = new Usuarios();
$usuarios->setUsuario($_SESSION['logado']);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $noticiaInfo = $noticia->buscar($id); // Verifique se a consulta retorna o índice correto
}

// Verificar se 'descricao' existe antes de usá-la
$descricao = isset($noticiaInfo['descricao']) ? $noticiaInfo['descricao'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o campo "descricao" foi enviado no POST
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $categoria = $_POST['categoria'];
    $data_publicacao = $_POST['data_publicacao'];
    $descricao = $_POST['descricao'];

    // Verifica se foi enviado um arquivo de imagem
    $imagem = $_FILES['imagem'];
    $excluirImagem = isset($_POST['excluir_imagem']) ? true : false; // Verifica se o usuário optou por excluir a imagem

    // Se o usuário escolheu excluir a imagem, apaga o arquivo do servidor
    if ($excluirImagem && !empty($noticiaInfo['imagem_noticia'])) {
        $imagemPath = 'img/noticias/' . $noticiaInfo['imagem_noticia'];
        if (file_exists($imagemPath)) {
            unlink($imagemPath); // Deleta a imagem do servidor
        }
        $imagemNome = null; // Remove a referência no banco
    } else {
        // Caso contrário, faz o upload de uma nova imagem se o usuário enviou uma
        if (!empty($imagem['name'])) {
            $imagemNome = md5(time() . rand(0, 9999)) . '.jpg';
            $imagemPath = 'img/noticias/' . $imagemNome;

            if (move_uploaded_file($imagem['tmp_name'], $imagemPath)) {
                // Imagem foi carregada com sucesso
            }
        } else {
            // Caso não tenha enviado uma nova imagem, mantém a imagem atual
            $imagemNome = $noticiaInfo['imagem_noticia'];
        }
    }

    // Atualiza os dados da notícia, incluindo a imagem
    $noticia->editar($titulo, $autor, $categoria, $data_publicacao, $descricao, $imagemNome, $id);

    header("Location: index.php");
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

            <!-- Data de Publicação -->
            <div class="form-group">
                <label for="data_publicacao">Data de Publicação:</label>
                <input type="date" class="form-control" id="data_publicacao" name="data_publicacao" value="<?php echo htmlspecialchars($noticiaInfo['data_publicacao']); ?>" required>
            </div>

            <!-- Descrição -->
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" id="descricao" name="descricao" required><?php echo htmlspecialchars($descricao); ?></textarea>
            </div>

            <!-- Imagem -->
            <div class="form-group">
                <label for="imagem">Imagem:</label>
                <input type="file" class="form-control" id="imagem" name="imagem">
                <?php if (!empty($noticiaInfo['imagem_noticia'])): ?>
                    <img src="img/noticias/<?php echo $noticiaInfo['imagem_noticia']; ?>" alt="Imagem atual" width="100"><br>
                <?php endif; ?>
                
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
