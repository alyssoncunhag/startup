<?php
session_start();
include 'classes/torneios.class.php';  // Alterando a inclusão da classe
include 'classes/usuarios.class.php';

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

$torneio = new Torneios();  // Alterando para a classe Torneios
$usuarios = new Usuarios();
$usuarios->setUsuario($_SESSION['logado']);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $torneioInfo = $torneio->buscar($id);  // Alterando para buscar o torneio
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $jogo = $_POST['jogo'];  // Alterando para o campo jogo
    $descricao = $_POST['descricao'];
    $data_inicio = $_POST['data_inicio'];  // Alterando para data de início
    $data_fim = $_POST['data_fim'];  // Alterando para data de fim

    // Atualiza os dados do torneio, incluindo a imagem
    $torneio->editar($nome, $jogo, $descricao, $data_inicio, $data_fim, $id);

    header("Location: indexTorneios.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Torneio</title>
    <link rel="stylesheet" href="css/editarTorneio.css">
</head>
<body>
    <div class="container">
        <h1>Editar Torneio</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $torneioInfo['id']; ?>">
            
            <!-- Nome -->
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $torneioInfo['nome']; ?>" required>
            </div>

            <!-- Jogo -->
            <div class="form-group">
                <label for="jogo">Jogo:</label>
                <input type="text" class="form-control" id="jogo" name="jogo" value="<?php echo $torneioInfo['jogo']; ?>" required>
            </div>

            <!-- Descrição -->
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" id="descricao" name="descricao" required><?php echo $torneioInfo['descricao']; ?></textarea>
            </div>

            <!-- Data de Início -->
            <div class="form-group">
                <label for="data_inicio">Data de Início:</label>
                <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="<?php echo $torneioInfo['data_inicio']; ?>" required>
            </div>

            <!-- Data de Fim -->
            <div class="form-group">
                <label for="data_fim">Data de Fim:</label>
                <input type="date" class="form-control" id="data_fim" name="data_fim" value="<?php echo $torneioInfo['data_fim']; ?>" required>
            </div>
            
            <!-- Botão de submit -->
            <button type="submit" class="btn-custom">Salvar</button>
        </form>
    </div>
</body>
</html>
