<?php
require "bd_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginUsername = $_POST["loginUsername"];
    $loginPassword = $_POST["loginPassword"];

    require "bd_conecction.php";

    $query = "SELECT * FROM users WHERE username = '$loginUsername' AND password = '$loginPassword'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        echo "Inicio de sesión exitoso. Bienvenido, $loginUsername.";
    } else {
        echo "Error en las credenciales de inicio de sesión.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Hotel Elegante</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header>
        <h1 class="hotel-title">Hotel Elegante</h1>
        <nav>
            <ul class="nav-list">
                <li><a href="#habitaciones">Habitaciones</a></li>
                <li><a href="#reservas">Reservas</a></li>
                <li><a href="login.php" class="btn-login">Log In</a></li>
                <li><a href="register.php" class="btn-register">Register</a></li>
            </ul>
        </nav>
    </header>

    <section id="login" class="login-section">
        <h2>Iniciar Sesión</h2>
        <form action="" method="post">
            <label for="loginUsername">Nombre de usuario:</label>
            <input type="text" name="loginUsername" required>
            <label for="loginPassword">Contraseña:</label>
            <input type="password" name="loginPassword" required>
            <input type="submit" name="login" value="Iniciar Sesión">
        </form>
    </section>
</body>
</html>
