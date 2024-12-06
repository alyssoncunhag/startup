<?php
session_start();
unset($_SESSION['Logado']);
header("Location: login.php");