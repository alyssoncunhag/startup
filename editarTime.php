<?php
session_start();
include 'classes/times.class.php';  // Alterado para 'times.class.php'
include 'classes/usuarios.class.php';

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

$time = new Times();  // Instância da classe Times
$usuarios = new Usuarios();
$usuarios->setUsuario($_SESSION['logado']);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $timeInfo = $time->buscar($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $pais = $_POST['pais'];
    $descricao = $_POST['descricao'];
    $imagem = $_FILES['imagem'];
    $excluirImagem = isset($_POST['excluir_imagem']) ? true : false; // Verifica se o usuário optou por excluir a imagem

    // Se o usuário escolheu excluir a imagem, apaga o arquivo do servidor
    if ($excluirImagem) {
        $imagemPath = 'img/times/' . $timeInfo['imagem'];
        if (file_exists($imagemPath)) {
            unlink($imagemPath); // Deleta a imagem do servidor
        }
        $imagemNome = null; // Remove a referência no banco
    } else {
        // Caso contrário, faz o upload de uma nova imagem se o usuário enviou uma
        if (!empty($imagem['name'])) {
            $imagemNome = md5(time() . rand(0, 9999)) . '.jpg';
            $imagemPath = 'img/times/' . $imagemNome;

            if (move_uploaded_file($imagem['tmp_name'], $imagemPath)) {
                // Imagem foi carregada com sucesso
            }
        } else {
            // Caso não tenha enviado uma nova imagem, mantém a imagem atual
            $imagemNome = $timeInfo['imagem'];
        }
    }

    // Atualiza os dados do time, incluindo a imagem
    $time->editar($nome, $pais, $descricao, $imagemNome, $id);

    header("Location: indexTimes.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Time</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/editarTime.css"> <!-- Link para o arquivo CSS que vamos usar -->
</head>
<body>
    <div class="container">
        <h1>Editar Time</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $timeInfo['id']; ?>">
            
            <!-- Nome -->
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $timeInfo['nome']; ?>" required>
            </div>

            <!-- País -->
            <div class="form-group">
                <label for="pais">País:</label>
                <input type="text" class="form-control" id="pais" name="pais" value="<?php echo $timeInfo['pais']; ?>" required>
            </div>

            <!-- Descrição -->
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" id="descricao" name="descricao" required><?php echo $timeInfo['descricao']; ?></textarea>
            </div>

            <!-- Imagem -->
            <div class="form-group">
                <label for="imagem">Imagem:</label>
                <input type="file" class="form-control" id="imagem" name="imagem">
                <img src="img/times/<?php echo $timeInfo['imagem']; ?>" alt="Imagem atual" width="100"><br>
                
                <!-- Texto acima do checkbox de excluir imagem -->
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
