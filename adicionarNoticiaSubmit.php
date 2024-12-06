<?php
include 'classes/noticias.class.php';
$noticia = new Noticias();

if(!empty($_POST['titulo'])){
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $categoria = $_POST['categoria'];
    $conteudo = $_POST['conteudo'];
    $data_publicacao = $_POST['data_publicacao'];
    
    // Verifica se foi enviado um arquivo de imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        // Obtenha as informações do arquivo enviado
        $imagem = $_FILES['imagem'];

        // Defina o diretório de destino para o upload da imagem
        $diretorioDestino = 'img/noticias/';

        // Gere um nome único para o arquivo de imagem
        $nomeImagem = md5(time() . rand(0, 9999)) . '.' . pathinfo($imagem['name'], PATHINFO_EXTENSION);

        // Caminho completo para o arquivo
        $caminhoImagem = $diretorioDestino . $nomeImagem;

        // Move o arquivo para o diretório de destino
        if (move_uploaded_file($imagem['tmp_name'], $caminhoImagem)) {
            // A imagem foi carregada com sucesso, armazene o nome no banco de dados
            $noticia->adicionar($titulo, $autor, $categoria, $conteudo, $data_publicacao, $nomeImagem);
            header('Location: indexNoticias.php');
            exit;
        } else {
            echo '<script type="text/javascript">alert("Erro ao fazer upload da imagem!");</script>';
        }
    } else {
        // Caso não tenha enviado uma imagem, salve apenas sem imagem
        $noticia->adicionar($titulo, $autor, $categoria, $conteudo, $data_publicacao, null);
        header('Location: indexNoticias.php');
        exit;
    }
} else {
    echo '<script type="text/javascript">alert("Título da notícia já cadastrado!");</script>';
}
?>
