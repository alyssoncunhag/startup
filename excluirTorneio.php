<?php
include 'classes/torneios.class.php';
$con = new Torneios();

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $con->deletar($id);
    header("Location: indexTorneios.php");
}