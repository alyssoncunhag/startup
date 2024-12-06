<?php
include 'classes/torneios.class.php';

$torneio = new Torneios();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OVERTIME - Administração de Torneios</title>

    <link rel="stylesheet" href="css/indexTorneios.css"> <!-- Aqui você inclui o CSS correto -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="wrapper">
        <header class="header">
            <h1 class="logo">OVERTIME - Torneios</h1>
            <nav class="nav">
                <a href="index.php" class="btn-main"><i class="fas fa-home"></i> Área Administrativa</a>
                <a href="sair.php" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </header>

        <main class="main-content">
            <section class="torneio-actions">
                <a href="adicionarTorneio.php" class="user-actions-btn btn-add"><i class="fas fa-plus"></i> Adicionar Torneio</a>
            </section>

            <section class="user-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Jogo</th>
                            <th>Data Início</th>
                            <th>Data Fim</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $lista = $torneio->listar();
                        foreach ($lista as $item):
                        ?>
                        <tr>
                            <td><?php echo $item['id']; ?></td>
                            <td><?php echo $item['nome']; ?></td>
                            <td><?php echo $item['jogo']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($item['data_inicio'])); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($item['data_fim'])); ?></td>
                            <td class="actions">
                                <a href="editarTorneio.php?id=<?php echo $item['id']; ?>" class="user-table-actions-btn btn-edit"><i class="fas fa-edit"></i> Editar</a>
                                <a href="excluirTorneio.php?id=<?php echo $item['id']; ?>" class="user-table-actions-btn btn-delete" onclick="return confirm('Você tem certeza que deseja excluir?')"><i class="fas fa-trash-alt"></i> Excluir</a>
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
