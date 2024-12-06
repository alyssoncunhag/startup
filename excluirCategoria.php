<?php
include 'classes/categorias.class.php';
$con = new Categorias();

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $con->deletar($id);
    header("Location: indexCategorias.php");
}