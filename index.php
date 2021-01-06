<?php
    session_start();
    require 'database.php';
    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT id, email, password FROM usuario where id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;
        if (count($results)>0) {
            $user = $results;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenid@ a la Aplicacion</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
        <br>Bienvenido. <?= $user['email']?>
        <br>Usted se ha logeado satisfactoriamente
        <a href="logout.php">Desconectar</a>
    <?php else: ?>

    <h1>Por favor Ingrese o Registrese</h1>
    <a href="login.php">Ingrese</a> o
    <a href="registrar.php">Registrese</a>
    <?php endif; ?>
</body>
</html>