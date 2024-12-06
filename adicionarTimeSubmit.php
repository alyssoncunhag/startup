<?php
include 'classes/times.class.php';  // Alterado para a classe Times
$time = new Times();  // Instanciando o objeto Time

if(!empty($_POST['nome'])){  // Alterado para verificar 'nome' ao invés de 'email'
    $nome = $_POST['nome'];
    $pais = $_POST['pais'];  // Alterado para 'pais' ao invés de 'telefone'
    $descricao = $_POST['descricao'];
    $imagem = $_POST['imagem'];  // Alterado para 'imagem' ao invés de 'foto'
    
    $time->adicionar($nome, $pais, $descricao, $imagem);  // Adaptado para o método adicionar para times
    header('Location: indexTimes.php');  // Redirecionamento para a lista de times
} else {
    echo '<script type="text/javascript">alert("Nome do time já cadastrado!");</script>';  // Mensagem de erro adaptada
}
?>
