<?php
include 'classes/usuarios.class.php';
$usuario = new Usuarios();

if(!empty($_POST['email'])){
    $nome = $_POST ['nome'];   
    $email = $_POST ['email'];
    $senha = $_POST ['senha'];
    $permissoes = $_POST ['permissoes'];
    $usuario->adicionar($email, $nome, $senha, $permissoes);
    header('Location: indexUsuarios.php');
} else {
    echo '<script type="text/javascript">alert("Email já cadastrado!");</script>';
}
