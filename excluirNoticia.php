<?php
include 'classes/noticias.class.php';
$con = new Noticias();

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $con->deletar($id);
    header("Location: indexNoticias.php");
}