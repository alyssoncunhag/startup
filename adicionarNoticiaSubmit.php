<?php
include 'classes/noticias.class.php';
$noticia = new Noticias();

if(!empty($_POST['titulo'])){
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $categoria = $_POST['categoria'];
    $conteudo = $_POST['conteudo'];
    $data_publicacao = $_POST['data_publicacao'];
    $imagem = $_POST['imagem'];
    $noticia->adicionar($titulo, $autor, $categoria, $conteudo, $data_publicacao, $imagem);
    header('Location: indexNoticias.php');
} else {
    echo '<script type="text/javascript">alert("Título da notícia já cadastrado!");</script>';
}
?>
