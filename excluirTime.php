<?php
include 'classes/times.class.php';
$con = new Times();

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $con->deletar($id);
    header("Location: indexTimes.php");
}