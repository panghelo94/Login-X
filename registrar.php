<?php 
    require 'database.php';

    $message='';

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $sql = "INSERT INTO usuario (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);//para cifrar la contraseña
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            $message = 'Usuario creado satisfactoriamente';
        }
        else {
            $message = "Lo sentimos, ocurrio un error creando su contraseña";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrese</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
    <p><?= $message ?></p>
    <?php endif; ?>


    <h1>Registrese</h1>
    <span>o <a href="login.php">Ingrese</a></span>
    <form action="registrar.php" method="post">
        <input type="text" name="email" placeholder="Ingrese su correo">
        <input type="password" name="password" placeholder="Ingrese tu contraseña">
        <input type="password" name="confirm_password" placeholder="Confirme tu contraseña">
        <input type="submit" value="Ingresar">
    </form>
</body>
</html>