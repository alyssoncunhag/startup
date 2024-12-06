<?php
include 'classes/jogos.class.php';
$con = new Jogos();

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $con->deletar($id);
    header("Location: indexJogos.php");
}