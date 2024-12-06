<?php
include 'classes/torneios.class.php';
$torneio = new Torneios();

if(!empty($_POST['nome'])){
    // Coleta os dados do torneio
    $nome = $_POST['nome'];
    $jogo = $_POST['jogo'];
    $descricao = $_POST['descricao'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];

    // Chama a função de adicionar torneio
    $torneio->adicionar($nome, $jogo, $descricao, $data_inicio, $data_fim);
    
    // Redireciona para a página principal
    header('Location: indexTorneios.php');
} else {
    echo '<script type="text/javascript">alert("Torneio já cadastrado!");</script>';
}
?>
