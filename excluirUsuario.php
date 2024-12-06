<?php
include 'classes/usuarios.class.php';
$con = new Usuarios();

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $con->deletar($id);
    header("Location: indexUsuarios.php");
}