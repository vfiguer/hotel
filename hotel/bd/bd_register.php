<?php
require "bd_connection.php";

$nombre = $email = $telefono = $dni = $contrasena = "";
$nombre_error = $email_error = $telefono_error = $dni_error = $contrasena_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nombre"])) {
        $nombre_error = "El nombre completo es obligatorio.";
    } else {
        $nombre = $_POST["nombre"];
    }

    if (empty($_POST["email"])) {
        $email_error = "El email es obligatorio.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_error = "Email no válido.";
    } else {
        $email = $_POST["email"];
    }

    if (empty($_POST["telefono"])) {
        $telefono_error = "El teléfono es obligatorio.";
    } else {
        $telefono = $_POST["telefono"];
    }

    if (empty($_POST["dni"])) {
        $dni_error = "El DNI es obligatorio.";
    } else {
        $dni = $_POST["dni"];
    }

    if (empty($_POST["contrasena"])) {
        $contrasena_error = "La contraseña es obligatoria.";
    } elseif (strlen($_POST["contrasena"]) < 8 || !preg_match("/[A-Z]/", $_POST["contrasena"]) || !preg_match("/[0-9]/", $_POST["contrasena"])) {
        $contrasena_error = "La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.";
    } else {
        $contrasena = $_POST["contrasena"];
    }

    if (empty($nombre_error) && empty($email_error) && empty($telefono_error) && empty($dni_error) && empty($contrasena_error)) {
        $query = "INSERT INTO customers (name, email, phone, dni, password) VALUES ('$nombre', '$email', '$telefono', '$dni', '$contrasena')";

        if (mysqli_query($conn, $query)) {
            echo "Registro exitoso. ¡Bienvenido, $nombre!";
        } else {
            echo "Error al registrar el usuario. Inténtalo de nuevo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Hotel Elegante</title>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
    <header>
        <h1 class="hotel-title">Hotel Elegante</h1>
    </header>

    <section id="registro" class="register-section">
        <h2>Registro de Usuario</h2>
        <form action="bd_register.php" method="post">
            <label for="nombre">Nombre completo:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required>
            <span class="error"><?php echo $nombre_error; ?></span>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
            <span class="error"><?php echo $email_error; ?></span>

            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" value="<?php echo $telefono; ?>" required>
            <span class="error"><?php echo $telefono_error; ?></span>

            <label for="dni">DNI:</label>
            <input type="text" name="dni" id="dni" value="<?php echo $dni; ?>" required>
            <span class="error"><?php echo $dni_error; ?></span>

            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" id="contrasena" required>
            <span class="error"><?php echo $contrasena_error; ?></span>

            <input type="submit" value="Registrarse">
        </form>

        
    </section>
</body>
</html>

