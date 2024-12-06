<?php
session_start();
require 'classes/usuarios.class.php';

if (!empty($_POST['email'])) {
    $email = addslashes($_POST['email']);
    $senha = $_POST['senha'];  // Não criptografe a senha aqui, vamos fazer isso com password_verify() depois

    $usuarios = new Usuarios();
    if ($usuarios->fazerLogin($email, $senha)) {
        header("Location: index.php");
        exit;
    } else {
        echo '<div class="alert alert-danger error-message" role="alert">Usuário e/ou senha incorreto!</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackAgenda - Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-container">
            <h1>Login</h1>
            <form method="POST">
     
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" name="email" placeholder="Digite seu email" required>
                </div>
              
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" name="senha" placeholder="Digite sua senha" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Entrar</button>
                <div class="forgot-password">
                    <a href="esqueceuSenha.php">Esqueci minha senha</a>
                </div>
            </form>
         
            <a href="home.php" class="btn btn-danger mt-3 w-100">Voltar para a Home</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
