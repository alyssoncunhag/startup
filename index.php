<?php
session_start();
include 'classes/usuarios.class.php';

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

$usuarios = new Usuarios();
$usuarios->setUsuario($_SESSION['logado']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overtime - Área Administrativa</title>

    <!-- Vinculando a folha de estilos externa -->
    <link rel="stylesheet" href="css/index.css">
    <!-- Adicionando o FontAwesome para os ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <header>
            <h1>Bem-vindo à Área Administrativa da OVERTIME</h1>
            <p class="subtitle">Aqui você pode gerenciar todas as seções do site.</p>
        </header>

        <div class="main-content">
            <div class="button-container">
                <?php if ($usuarios->temPermissoes("SUPER, ADD, EDIT, DELETE")): ?>
                    <button onclick="window.location.href='indexUsuarios.php';">Gerenciar Usuários</button>
                    <button onclick="window.location.href='indexCategorias.php';">Gerenciar Categorias</button>
                    <button onclick="window.location.href='indexTimes.php';">Gerenciar Times</button>
                    <button onclick="window.location.href='indexTorneios.php';">Gerenciar Torneios</button>
                    <button onclick="window.location.href='indexNoticias.php';">Gerenciar Notícias</button>
                    <button onclick="window.location.href='indexJogos.php';">Gerenciar Jogos</button>
                <?php else: ?>
                    <p>Você não tem permissão para acessar essa área.</p>
                <?php endif; ?>

                <button class="logout-btn" onclick="window.location.href='sair.php';">SAIR</button>
            </div>
        </div>
    </div>

    <!-- Rodapé fora do wrapper -->
    <footer>
        <p>© 2024 OVERTIME. Todos os direitos reservados. 
            <a href="sobre.php">Sobre Nós</a> | <a href="contato.php">Contato</a>
        </p>
    </footer>
</body>

</html>
