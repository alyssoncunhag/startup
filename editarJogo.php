<?php
session_start();
include 'classes/jogos.class.php';
include 'classes/usuarios.class.php';

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

$jogo = new Jogos(); // Mudado de 'Contatos' para 'Jogos'
$usuarios = new Usuarios();
$usuarios->setUsuario($_SESSION['logado']);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $jogoInfo = $jogo->buscar($id); // Buscar dados do jogo
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $data_lancamento = $_POST['data_lancamento'];
    $imagem = $_FILES['imagem']; // Agora 'imagem' no lugar de 'foto'
    $excluirImagem = isset($_POST['excluir_imagem']) ? true : false; // Verifica se o usuário optou por excluir a imagem

    // Se o usuário escolheu excluir a imagem, apaga o arquivo do servidor
    if ($excluirImagem) {
        $imagemPath = 'img/jogos/' . $jogoInfo['imagem'];
        if (file_exists($imagemPath)) {
            unlink($imagemPath); // Deleta a imagem do servidor
        }
        $imagemNome = null; // Remove a referência no banco
    } else {
        // Caso contrário, faz o upload de uma nova imagem se o usuário enviou uma
        if (!empty($imagem['name'])) {
            $imagemNome = md5(time() . rand(0, 9999)) . '.jpg';
            $imagemPath = 'img/jogos/' . $imagemNome;

            if (move_uploaded_file($imagem['tmp_name'], $imagemPath)) {
                // Imagem foi carregada com sucesso
            }
        } else {
            // Caso não tenha enviado uma nova imagem, mantém a imagem atual
            $imagemNome = $jogoInfo['imagem'];
        }
    }

    // Atualiza os dados do jogo, incluindo a imagem
    $jogo->editar($nome, $descricao, $data_lancamento, $imagemNome, $id);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Jogo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/editarJogo.css"> <!-- Link para o arquivo CSS específico -->
</head>
<body>
    <div class="container">
        <h1>Editar Jogo</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $jogoInfo['id']; ?>">
            
            <!-- Nome do Jogo -->
            <div class="form-group">
                <label for="nome">Nome do Jogo:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $jogoInfo['nome']; ?>" required>
            </div>

            <!-- Descrição do Jogo -->
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" id="descricao" name="descricao" required><?php echo $jogoInfo['descricao']; ?></textarea>
            </div>

            <!-- Data de Lançamento -->
            <div class="form-group">
                <label for="data_lancamento">Data de Lançamento:</label>
                <input type="date" class="form-control" id="data_lancamento" name="data_lancamento" value="<?php echo $jogoInfo['data_lancamento']; ?>" required>
            </div>

            <!-- Imagem do Jogo -->
            <div class="form-group">
                <label for="imagem">Imagem:</label>
                <input type="file" class="form-control" id="imagem" name="imagem">
                <img src="img/jogos/<?php echo $jogoInfo['imagem']; ?>" alt="Imagem atual" width="100"><br>
                
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
