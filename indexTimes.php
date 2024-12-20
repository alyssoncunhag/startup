<?php
include 'classes/times.class.php';

$time = new Times();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OVERTIME - Administração de Times</title>

    <link rel="stylesheet" href="css/indexTimes.css">
    <!-- Adicionando o FontAwesome para os ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="wrapper">
        <header class="header">
            <h1 class="logo">OVERTIME - Times</h1>
            <nav class="nav">
                <a href="index.php" class="btn-main"><i class="fas fa-home"></i> Área Administrativa</a>
                <a href="sair.php" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </header>

        <main class="main-content">
            <section class="torneio-actions">
                <a href="adicionarTime.php" class="user-actions-btn"><i class="fas fa-plus"></i> Adicionar Time</a>
            </section>

            <section class="user-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>País</th>
                            <th>Descrição</th>
                            <th>Imagem</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $lista = $time->listar();
                        foreach ($lista as $item):
                        ?>
                        <tr>
                            <td><?php echo $item['id']; ?></td>
                            <td><?php echo $item['nome']; ?></td>
                            <td><?php echo $item['pais']; ?></td>
                            <td><?php echo $item['descricao']; ?></td>
                            <td>
                                <?php if (!empty($item['imagem'])): ?>
                                            <img src="img/times/<?php echo $item['imagem']; ?>" class="img-thumbnail" style="width: 100px; height: 100px;">
                                        <?php endif; ?>
                            </td>
                            <td class="actions">
                                <a href="editarTime.php?id=<?php echo $item['id']; ?>" class="user-table-actions-btn"><i class="fas fa-edit"></i> Editar</a>
                                <a href="excluirTime.php?id=<?php echo $item['id']; ?>" class="user-table-actions-btn" onclick="return confirm('Você tem certeza que deseja excluir?')"><i class="fas fa-trash-alt"></i> Excluir</a>
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
