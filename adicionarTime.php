<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Time</title>
    
    <!-- Link para o arquivo CSS externo -->
    <link rel="stylesheet" href="css/adicionarTime.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Adicionar Time</h1>
            <form method="POST" action="adicionarTimeSubmit.php">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>

                <div class="form-group">
                    <label for="pais">País:</label>
                    <input type="text" class="form-control" id="pais" name="pais" required>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" required>
                </div>

                <div class="form-group">
                    <label for="imagem">Imagem:</label>
                    <input type="file" class="form-control" id="imagem" name="imagem" required>
                </div>

                <button type="submit" name="btCadastrar" class="btn-custom">Adicionar</button>
            </form>

            <div class="back-btn">
                <a href="index.php" class="back-link"><i class="fas fa-arrow-left"></i> Voltar para a lista de times</a>
            </div>
        </div>
    </div>

    <!-- Adicionando scripts do Bootstrap e FontAwesome -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>