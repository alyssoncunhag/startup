<?php
include 'classes/usuarios.class.php';
$usuario = new Usuarios();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $info = $usuario->buscar($id);
    if (empty($info['email'])) {
        header("Location: indexUsuarios.php");
        exit;
    }
} else {
    header("Location: indexUsuarios.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>

    <!-- Link do Bootstrap para deixar a página mais moderna -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Link para o CSS externo -->
    <link rel="stylesheet" href="css/editarUsuario.css">
</head>
<body>

<div class="container">
    <h1>Editar Usuário</h1>

    <!-- Formulário de Edição de Usuário -->
    <form method="POST" action="editarUsuarioSubmit.php">
        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">

        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $info['nome']; ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $info['email']; ?>" required>
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" value="">
        </div>

        <div class="form-group">
            <label for="permissoes">Permissões:</label>
            <input type="text" class="form-control" id="permissoes" name="permissoes" value="<?php echo $info['permissoes']; ?>" required>
        </div>

        <button type="submit" name="btAlterar" class="btn btn-custom">Salvar</button>
    </form>
</div>

<!-- Scripts do Bootstrap e FontAwesome -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
