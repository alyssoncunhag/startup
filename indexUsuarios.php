<?php
include 'classes/usuarios.class.php';

$usuario = new Usuarios();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OVERTIME - Administração de Usuários</title>

    <link rel="stylesheet" href="css/indexUsuarios.css">
    <!-- Adicionando o FontAwesome para os ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="wrapper">
        <header class="header">
            <h1 class="logo">OVERTIME - Usuários</h1>
            <nav class="nav">
                <a href="index.php" class="btn-main"><i class="fas fa-home"></i> Área Administrativa</a>
                <a href="sair.php" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </header>

        <main class="main-content">
            <section class="user-actions">
                <a href="adicionarUsuario.php" class="btn-add"><i class="fas fa-plus"></i> Adicionar Usuário</a>
            </section>

            <section class="user-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Permissões</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $lista = $usuario->listar();
                        foreach ($lista as $item):
                        ?>
                        <tr>
                            <td><?php echo $item['id']; ?></td>
                            <td><?php echo $item['nome']; ?></td>
                            <td><?php echo $item['email']; ?></td>
                            <td><?php echo $item['permissoes']; ?></td>
                            <td class="actions">
                                <a href="editarUsuario.php?id=<?php echo $item['id']; ?>" class="btn-action btn-edit"><i class="fas fa-edit"></i> Editar</a>
                                <a href="excluirUsuario.php?id=<?php echo $item['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Você tem certeza que deseja excluir?')"><i class="fas fa-trash-alt"></i> Excluir</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

</body>
</html>
