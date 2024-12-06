<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Usuário</title>

    <!-- Link para o CSS externo -->
    <link rel="stylesheet" href="css/adicionarUsuario.css">
</head>
<body>

<div class="container">
    <h1>Adicionar Usuário</h1>

    <!-- Formulário de Adição de Usuário -->
    <form method="POST" action="adicionarUsuarioSubmit.php">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>

        <div class="form-group">
            <label for="permissoes">Permissões:</label>
            <input type="text" class="form-control" id="permissoes" name="permissoes" required>
        </div>

        <button type="submit" name="btCadastrar" class="btn-custom">Adicionar Usuário</button>
    </form>
</div>

</body>
</html>
