<?php

    session_start();

    if (isset($_SESSION['userd_id'])) {
        header('Location: /php-login');
    }
    require 'database.php';

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $records = $conn->prepare('SELECT id, email, password FROM usuario where email = :email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if (count($results)>0 && password_verify($_POST['password'], $results['password'])) {
            $_SESSION['user_id'] = $results['id']; //Session permite almacenar datos
            header('Location: /php-login');
        }else{
            $message = "Lo sentimos, tus credenciales no coinciden";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title> 
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php' ?>
    <h1>Ingrese</h1>
    <?php if (!empty($message)): ?>
        <p><?= $message?></p>
    <?php endif; ?>
    <span>o <a href="registrar.php">Registrese</a></span>
    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Ingrese su correo">
        <input type="password" name="password" placeholder="Ingrese tu contraseña">
        <input type="submit" value="Ingresar">
    </form>
</body>
</html>