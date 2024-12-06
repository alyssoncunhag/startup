<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Notícia</title>
    
    <!-- Link para o arquivo CSS externo -->
    <link rel="stylesheet" href="css/adicionarNoticia.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Adicionar Notícia</h1>
            <form method="POST" action="adicionarNoticiaSubmit.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                </div>

                <div class="form-group">
                    <label for="autor">Autor:</label>
                    <input type="text" class="form-control" id="autor" name="autor" required>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <input type="text" class="form-control" id="categoria" name="categoria" required>
                </div>

                <div class="form-group">
                    <label for="conteudo">Conteúdo:</label>
                    <textarea class="form-control" id="conteudo" name="conteudo" rows="5" required></textarea>
                </div>

                <div class="form-group">
                    <label for="data_publicacao">Data de Publicação:</label>
                    <input type="date" class="form-control" id="data_publicacao" name="data_publicacao" required>
                </div>

                <div class="form-group">
                    <label for="imagem">Imagem:</label>
                    <input type="file" class="form-control" id="imagem" name="imagem" required>
                </div>

                <button type="submit" name="btCadastrar" class="btn-custom">Adicionar</button>
            </form>

            <div class="back-btn">
                <a href="index.php" class="back-link"><i class="fas fa-arrow-left"></i> Voltar para a lista de notícias</a>
            </div>
        </div>
    </div>

    <!-- Adicionando scripts do Bootstrap e FontAwesome -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
