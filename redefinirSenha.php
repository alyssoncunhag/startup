<?php
require 'classes/usuarios.class.php';

if (!empty($_GET['email']) && !empty($_POST['nova_senha'])) {
    $email = addslashes($_GET['email']);
    $novaSenha = $_POST['nova_senha'];

    // Usar o método correto de criptografia
    $usuarios = new Usuarios();
    if ($usuarios->atualizarSenha($email, $novaSenha)) {
        // Redireciona para a página de login após sucesso
        header("Location: login.php?mensagem=sucesso");
        exit;
    } else {
        $erro = "Ocorreu um erro ao redefinir sua senha.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/redefinirSenha.css" rel="stylesheet"> <!-- Link para o arquivo CSS -->
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Redefinir Senha</h1>
            </div>
            <div class="card-body">
                <?php if (isset($erro)): ?>
                    <div class="alert alert-danger text-center">
                        <?= $erro; ?>
                    </div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="nova_senha" class="form-label">Digite sua nova senha:</label>
                        <input type="password" name="nova_senha" id="nova_senha" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Redefinir Senha</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
