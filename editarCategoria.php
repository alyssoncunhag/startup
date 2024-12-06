<?php
session_start();
include 'classes/categorias.class.php';  // Altere para a classe Categorias
include 'classes/usuarios.class.php';

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

$categoria = new Categorias(); // Instância da classe Categorias
$usuarios = new Usuarios();
$usuarios->setUsuario($_SESSION['logado']);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $categoriaInfo = $categoria->buscar($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    // Atualiza os dados da categoria
    $categoria->editar($nome, $descricao, $id);

    header("Location: indexCategorias.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/editarCategoria.css"> <!-- Link para o arquivo CSS que vamos usar -->
</head>
<body>
    <div class="container">
        <h1>Editar Categoria</h1>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $categoriaInfo['id']; ?>">
            
            <!-- Nome da Categoria -->
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $categoriaInfo['nome']; ?>" required>
            </div>

            <!-- Descrição da Categoria -->
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" id="descricao" name="descricao" required><?php echo $categoriaInfo['descricao']; ?></textarea>
            </div>

            <!-- Botão de submit -->
            <button type="submit" class="btn btn-custom">Salvar</button>
        </form>
    </div>
</body>
</html>
