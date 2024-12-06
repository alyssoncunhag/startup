<?php
include 'classes/noticias.class.php';

$noticia = new Noticias();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OVERTIME - Administração de Notícias</title>

    <link rel="stylesheet" href="css/indexNoticias.css">
    <!-- Adicionando o FontAwesome para os ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="wrapper">
        <header class="header">
            <h1 class="logo">OVERTIME - Notícias</h1>
            <nav class="nav">
                <a href="index.php" class="btn-main"><i class="fas fa-home"></i> Área Administrativa</a>
                <a href="sair.php" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </header>

        <main class="main-content">
            <section class="torneio-actions">
                <a href="adicionarNoticia.php" class="user-actions-btn"><i class="fas fa-plus"></i> Adicionar Notícia</a>
            </section>

            <section class="user-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Categoria</th>
                            <th>Data de Publicação</th>
                            <th>Imagem</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $lista = $noticia->listar();
                        foreach ($lista as $item):
                        ?>
                        <tr>
                            <td><?php echo $item['id']; ?></td>
                            <td><?php echo $item['titulo']; ?></td>
                            <td><?php echo $item['autor']; ?></td>
                            <td><?php echo $item['categoria']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($item['data_publicacao'])); ?></td>
                            <td><img src="images/<?php echo $item['imagem']; ?>" alt="Imagem da notícia" width="50"></td>
                            <td class="actions">
                                <a href="editarNoticia.php?id=<?php echo $item['id']; ?>" class="user-table-actions-btn"><i class="fas fa-edit"></i> Editar</a>
                                <a href="excluirNoticia.php?id=<?php echo $item['id']; ?>" class="user-table-actions-btn" onclick="return confirm('Você tem certeza que deseja excluir?')"><i class="fas fa-trash-alt"></i> Excluir</a>
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
