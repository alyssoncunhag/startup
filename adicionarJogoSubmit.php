<?php
include 'classes/jogos.class.php';  
$jogo = new Jogos();  

if (!empty($_POST['nome'])){ 
    $nome = $_POST['nome'];  
    $descricao = $_POST['descricao'];  
    $data_lancamento = $_POST['data_lancamento'];  
    $imagem = $_POST['imagem'];  

    // Passando todos os 5 parâmetros necessários para o método 'adicionar'
    $jogo->adicionar($nome, $descricao, $data_lancamento, $imagem);  
    header('Location: indexJogos.php');
} else {
    echo '<script type="text/javascript">alert("Nome do jogo ou outro campo obrigatório não foi preenchido!");</script>';
}
?>
