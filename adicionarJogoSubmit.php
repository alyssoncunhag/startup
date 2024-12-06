<?php
include 'classes/jogos.class.php';  
$jogo = new Jogos();  

if (!empty($_POST['nome']) && !empty($_POST['jogo'])) {  // Verificando também o parâmetro 'jogo'
    $nome = $_POST['nome'];  
    $jogo_nome = $_POST['jogo'];  // Supondo que você tenha um campo 'jogo' no formulário
    $descricao = $_POST['descricao'];  
    $data_lancamento = $_POST['data_lancamento'];  
    $imagem = $_POST['imagem'];  

    // Passando todos os 5 parâmetros necessários para o método 'adicionar'
    $jogo->adicionar($nome, $jogo_nome, $descricao, $data_lancamento, $imagem);  
    header('Location: indexJogos.php');
} else {
    echo '<script type="text/javascript">alert("Nome do jogo ou outro campo obrigatório não foi preenchido!");</script>';
}
?>
