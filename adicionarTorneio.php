<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Torneio</title>
    
    <!-- Link para o arquivo CSS externo -->
    <link rel="stylesheet" href="css/adicionarTorneio.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Adicionar Torneio</h1>
            <form method="POST" action="adicionarTorneioSubmit.php">
                <div class="form-group">
                    <label for="nome">Nome do Torneio:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>

                <div class="form-group">
                    <label for="jogo">Jogo:</label>
                    <input type="text" id="jogo" name="jogo" required>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" id="descricao" name="descricao" required>
                </div>

                <div class="form-group">
                    <label for="data_inicio">Data de Início:</label>
                    <input type="date" id="data_inicio" name="data_inicio" required>
                </div>

                <div class="form-group">
                    <label for="data_fim">Data de Fim:</label>
                    <input type="date" id="data_fim" name="data_fim" required>
                </div>

                <button type="submit" name="btCadastrar" class="btn-custom">Adicionar</button>
            </form>

            <div class="back-btn">
                <a href="indexTorneios.php" class="back-link"><i class="fas fa-arrow-left"></i> Voltar para a lista de torneios</a>
            </div>
        </div>
    </div>

    <!-- Adicionando scripts do Bootstrap e FontAwesome -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
