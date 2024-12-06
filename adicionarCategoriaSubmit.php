<?php
include 'classes/categorias.class.php';  // Alterado para usar a classe de categorias
$categoria = new Categorias();  // Instanciando a classe Categorias

if(!empty($_POST['nome'])){  // Verificando se o nome da categoria foi enviado
    $nome = $_POST['nome'];  // Variável para o nome da categoria
    $descricao = $_POST['descricao'];  // Variável para a descrição da categoria
    
    // Chama o método de adicionar categoria
    $categoria->adicionar($nome, $descricao);  
    header('Location: indexCategorias.php');  // Redireciona para a lista de categorias
} else {
    echo '<script type="text/javascript">alert("Categoria já cadastrada!");</script>';  // Exibe alerta caso a categoria não seja válida
}
?>
